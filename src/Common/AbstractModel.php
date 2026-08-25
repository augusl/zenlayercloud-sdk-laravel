<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Common;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use ReflectionClass;
use ReflectionNamedType;
use stdClass;
use TypeError;

/**
 * Base class for every Request, Response, and nested model class.
 *
 * Subclasses declare public typed nullable properties that match the JSON field
 * names exactly (camelCase). For properties whose type is `array` of nested
 * AbstractModel objects, subclasses list them in `$_typeMap`; generated scalar
 * lists use `$_scalarArrayTypeMap`. Both maps enforce element types during
 * serialization and hydration.
 *
 *     class FooRequest extends AbstractModel {
 *         public ?string $instanceId = null;
 *         public ?Bar    $bar        = null;
 *
 *         /** @var Baz[]|null *\/
 *         public ?array  $baz        = null;
 *         protected static array $_typeMap = ['baz' => Baz::class];
 *     }
 *
 * @implements Arrayable<string,mixed>
 */
abstract class AbstractModel implements Arrayable, JsonSerializable
{
    /**
     * Map of property-name => nested-class for `array<NestedModel>` fields.
     *
     * @var array<string,class-string<AbstractModel>>
     */
    protected static array $_typeMap = [];

    /**
     * Map of property-name => scalar type for generated scalar-list fields.
     *
     * @var array<string,'string'|'int'|'float'|'bool'>
     */
    protected static array $_scalarArrayTypeMap = [];

    /**
     * Hydrate this instance from a (decoded) JSON array. Recurses through
     * nested models and arrays-of-models when declared via $_typeMap.
     *
     * Unknown keys in $data are ignored, so the SDK keeps working when the
     * Zenlayer API adds new response fields.
     *
     * @param  array<string,mixed>  $data
     */
    public function fromArray(array $data): static
    {
        $ref = new ReflectionClass($this);
        $typeMap = static::$_typeMap;
        $scalarArrayTypeMap = static::$_scalarArrayTypeMap;

        foreach ($data as $key => $value) {
            $name = (string) $key;
            if (! $ref->hasProperty($name)) {
                continue;
            }
            $property = $ref->getProperty($name);
            if ($property->isStatic()) {
                continue;
            }
            $this->{$name} = $this->hydrateValue(
                $name,
                $value,
                $property->getType(),
                $typeMap,
                $scalarArrayTypeMap,
            );
        }

        return $this;
    }

    /**
     * Serialize this instance to an associative array suitable for json_encode.
     * Null-valued properties are omitted (equivalent to Go `omitempty` on pointers).
     *
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        $out = [];
        foreach (get_object_vars($this) as $name => $value) {
            if ($value === null) {
                continue;
            }
            $out[$name] = $this->normalizeFieldValue($name, $value);
        }

        return $out;
    }

    /**
     * Serialize this instance to JSON. Empty objects are emitted as `{}`.
     */
    public function toJson(): string
    {
        return json_encode(
            $this,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR,
        );
    }

    /**
     * Make models safe and predictable with Laravel responses and json_encode.
     * Empty models remain JSON objects (`{}`), not JSON arrays (`[]`).
     */
    public function jsonSerialize(): mixed
    {
        $payload = $this->toArray();

        return $payload === [] ? new stdClass : $payload;
    }

    /**
     * @param  array<string,class-string<AbstractModel>>  $typeMap
     * @param  array<string,'string'|'int'|'float'|'bool'>  $scalarArrayTypeMap
     */
    private function hydrateValue(
        string $key,
        mixed $value,
        mixed $type,
        array $typeMap,
        array $scalarArrayTypeMap,
    ): mixed {
        // List of nested models declared in $_typeMap (typed array)
        if (isset($typeMap[$key])) {
            if ($value === null) {
                return null;
            }

            if (! is_array($value) || ! array_is_list($value)) {
                throw new TypeError("{$key} must be an array of models.");
            }

            $class = $typeMap[$key];
            $items = [];
            foreach ($value as $item) {
                if ($item instanceof stdClass) {
                    $item = get_object_vars($item);
                }

                // `json_decode(..., true)` represents an empty object as [], so
                // keep accepting that one ambiguous value. A non-empty list is
                // unambiguously not a JSON object and must be rejected.
                if (! is_array($item) || ($item !== [] && array_is_list($item))) {
                    throw new TypeError("Every {$key} item must be an object.");
                }

                $items[] = (new $class)->fromArray($item);
            }

            return $items;
        }

        if (isset($scalarArrayTypeMap[$key])) {
            return $this->normalizeScalarArray($key, $value, $scalarArrayTypeMap[$key]);
        }

        // Single nested AbstractModel
        if ($type instanceof ReflectionNamedType && ! $type->isBuiltin()) {
            $class = $type->getName();
            if ($value instanceof stdClass) {
                $value = get_object_vars($value);
            }
            if (is_subclass_of($class, self::class) && is_array($value)) {
                if ($value !== [] && array_is_list($value)) {
                    throw new TypeError("{$key} must be an object.");
                }

                /** @var AbstractModel $nested */
                $nested = new $class;

                return $nested->fromArray($value);
            }
        }

        return $value;
    }

    private function normalizeFieldValue(string $name, mixed $value): mixed
    {
        if (isset(static::$_typeMap[$name])) {
            if (! is_array($value) || ! array_is_list($value)) {
                throw new TypeError("{$name} must be an array of models.");
            }

            $class = static::$_typeMap[$name];
            foreach ($value as $item) {
                if (! $item instanceof $class) {
                    throw new TypeError("Every {$name} item must be an instance of {$class}.");
                }
            }
        }

        if (isset(static::$_scalarArrayTypeMap[$name])) {
            $value = $this->normalizeScalarArray($name, $value, static::$_scalarArrayTypeMap[$name]);
        }

        return $this->normalizeValue($value);
    }

    /**
     * @param  'string'|'int'|'float'|'bool'  $type
     * @return list<string|int|float|bool>|null
     */
    private function normalizeScalarArray(string $name, mixed $value, string $type): ?array
    {
        if ($value === null) {
            return null;
        }

        if (! is_array($value) || ! array_is_list($value)) {
            throw new TypeError("{$name} must be a list of {$type} values.");
        }

        $items = [];
        foreach ($value as $item) {
            $valid = match ($type) {
                'string' => is_string($item),
                'int' => is_int($item),
                'float' => is_float($item) || is_int($item),
                'bool' => is_bool($item),
            };

            if (! $valid) {
                throw new TypeError("Every {$name} item must be a {$type}.");
            }

            $items[] = $type === 'float' ? (float) $item : $item;
        }

        return $items;
    }

    private function normalizeValue(mixed $value): mixed
    {
        if ($value instanceof self) {
            $nested = $value->toArray();

            // An all-null nested model must serialize as a JSON object `{}`,
            // not an array `[]` — matching Go's json.Marshal of an empty
            // struct. Returning an empty PHP array would encode as `[]`.
            return $nested === [] ? new stdClass : $nested;
        }
        if (is_array($value)) {
            $out = [];
            foreach ($value as $k => $v) {
                $out[$k] = $this->normalizeValue($v);
            }

            return $out;
        }

        return $value;
    }
}
