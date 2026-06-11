<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Common;

use ReflectionClass;
use ReflectionNamedType;

/**
 * Base class for every Request, Response, and nested model class.
 *
 * Subclasses declare public typed nullable properties that match the JSON field
 * names exactly (camelCase). For properties whose type is `array` of nested
 * AbstractModel objects, subclasses must list them in `$_typeMap` so that
 * deserialization can rebuild typed objects.
 *
 *     class FooRequest extends AbstractModel {
 *         public ?string $instanceId = null;
 *         public ?Bar    $bar        = null;
 *
 *         /** @var Baz[]|null *\/
 *         public ?array  $baz        = null;
 *         protected static array $_typeMap = ['baz' => Baz::class];
 *     }
 */
abstract class AbstractModel
{
    /**
     * Map of property-name => nested-class for `array<NestedModel>` fields.
     *
     * @var array<string,class-string<AbstractModel>>
     */
    protected static array $_typeMap = [];

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

        foreach ($data as $key => $value) {
            $name = (string) $key;
            if (! $ref->hasProperty($name)) {
                continue;
            }
            $property = $ref->getProperty($name);
            if ($property->isStatic()) {
                continue;
            }
            $this->{$name} = $this->hydrateValue($name, $value, $property->getType(), $typeMap);
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
            $out[$name] = $this->normalizeValue($value);
        }

        return $out;
    }

    /**
     * Serialize this instance to JSON. Empty objects are emitted as `{}`.
     */
    public function toJson(): string
    {
        $payload = $this->toArray();
        if ($payload === []) {
            return '{}';
        }

        return json_encode(
            $payload,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR,
        );
    }

    /**
     * @param  array<string,class-string<AbstractModel>>  $typeMap
     */
    private function hydrateValue(string $key, mixed $value, mixed $type, array $typeMap): mixed
    {
        // List of nested models declared in $_typeMap (typed array)
        if (isset($typeMap[$key]) && is_array($value)) {
            $class = $typeMap[$key];
            $items = [];
            foreach ($value as $item) {
                $items[] = is_array($item)
                    ? (new $class)->fromArray($item)
                    : $item;
            }

            return $items;
        }

        // Single nested AbstractModel
        if ($type instanceof ReflectionNamedType && ! $type->isBuiltin()) {
            $class = $type->getName();
            if (is_subclass_of($class, self::class) && is_array($value)) {
                /** @var AbstractModel $nested */
                $nested = new $class;

                return $nested->fromArray($value);
            }
        }

        return $value;
    }

    private function normalizeValue(mixed $value): mixed
    {
        if ($value instanceof self) {
            $nested = $value->toArray();

            // An all-null nested model must serialize as a JSON object `{}`,
            // not an array `[]` — matching Go's json.Marshal of an empty
            // struct. Returning an empty PHP array would encode as `[]`.
            return $nested === [] ? new \stdClass : $nested;
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
