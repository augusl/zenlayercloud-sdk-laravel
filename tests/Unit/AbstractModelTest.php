<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ZenlayerCloud\Laravel\Common\AbstractModel;

/** Test fixtures live inside this file (see classes below the test). */
final class AbstractModelTest extends TestCase
{
    public function test_to_array_omits_null_properties(): void
    {
        $req = new TestRootModel;
        $req->stringVal = 'hello';
        $req->intVal = 42;
        // boolVal, listVal, nested, items intentionally left null

        self::assertSame(
            ['stringVal' => 'hello', 'intVal' => 42],
            $req->toArray(),
        );
    }

    public function test_to_array_handles_nested_model_and_typed_array(): void
    {
        $nested = new TestNestedModel;
        $nested->field = 'nested-value';

        $item1 = new TestItemModel;
        $item1->itemId = 'item-1';
        $item2 = new TestItemModel;
        $item2->itemId = 'item-2';

        $req = new TestRootModel;
        $req->stringVal = 'root';
        $req->nested = $nested;
        $req->items = [$item1, $item2];

        self::assertSame(
            [
                'stringVal' => 'root',
                'nested' => ['field' => 'nested-value'],
                'items' => [
                    ['itemId' => 'item-1'],
                    ['itemId' => 'item-2'],
                ],
            ],
            $req->toArray(),
        );
    }

    public function test_from_array_hydrates_scalars_and_unknown_keys_are_ignored(): void
    {
        $req = (new TestRootModel)->fromArray([
            'stringVal' => 'val',
            'intVal' => 7,
            'boolVal' => true,
            'listVal' => ['a', 'b'],
            'unknownKey' => 'should-be-ignored',
        ]);

        self::assertSame('val', $req->stringVal);
        self::assertSame(7, $req->intVal);
        self::assertTrue($req->boolVal);
        self::assertSame(['a', 'b'], $req->listVal);
    }

    public function test_from_array_hydrates_nested_model(): void
    {
        $req = (new TestRootModel)->fromArray([
            'nested' => ['field' => 'inner'],
        ]);

        self::assertInstanceOf(TestNestedModel::class, $req->nested);
        self::assertSame('inner', $req->nested->field);
    }

    public function test_from_array_hydrates_stdclass_nested_values_from_single_json_decode(): void
    {
        $req = (new TestRootModel)->fromArray([
            'nested' => (object) ['field' => 'inner'],
            'items' => [
                (object) ['itemId' => 'a'],
                (object) ['itemId' => 'b'],
            ],
        ]);

        self::assertInstanceOf(TestNestedModel::class, $req->nested);
        self::assertSame('inner', $req->nested->field);
        self::assertInstanceOf(TestItemModel::class, $req->items[0]);
        self::assertSame('a', $req->items[0]->itemId);
        self::assertSame('b', $req->items[1]->itemId);
    }

    public function test_from_array_hydrates_array_of_models_via_type_map(): void
    {
        $req = (new TestRootModel)->fromArray([
            'items' => [
                ['itemId' => 'a'],
                ['itemId' => 'b'],
            ],
        ]);

        self::assertIsArray($req->items);
        self::assertCount(2, $req->items);
        self::assertInstanceOf(TestItemModel::class, $req->items[0]);
        self::assertSame('a', $req->items[0]->itemId);
        self::assertSame('b', $req->items[1]->itemId);
    }

    public function test_roundtrip_preserves_data(): void
    {
        $original = [
            'stringVal' => 'x',
            'intVal' => 9,
            'boolVal' => false,
            'listVal' => ['p', 'q'],
            'nested' => ['field' => 'deep'],
            'items' => [
                ['itemId' => 'i1'],
                ['itemId' => 'i2'],
            ],
        ];

        $req = (new TestRootModel)->fromArray($original);

        self::assertSame($original, $req->toArray());
    }

    public function test_to_json_emits_empty_object_when_no_fields_set(): void
    {
        self::assertSame('{}', (new TestRootModel)->toJson());
    }

    public function test_to_json_emits_empty_nested_model_as_object_not_array(): void
    {
        // An all-null nested model must encode as `{}`, not `[]` — matching
        // Go's json.Marshal of an empty struct.
        $req = new TestRootModel;
        $req->nested = new TestNestedModel; // all fields null

        self::assertSame('{"nested":{}}', $req->toJson());
    }

    public function test_to_json_emits_array_of_empty_nested_models_as_objects(): void
    {
        $req = new TestRootModel;
        $req->items = [new TestItemModel, new TestItemModel]; // all fields null

        self::assertSame('{"items":[{},{}]}', $req->toJson());
    }

    public function test_to_json_preserves_unicode_unescaped(): void
    {
        $req = new TestRootModel;
        $req->stringVal = '测试';

        self::assertSame('{"stringVal":"测试"}', $req->toJson());
    }

    public function test_models_are_laravel_arrayable_and_json_serializable(): void
    {
        $model = new TestRootModel;
        $model->stringVal = 'visible';

        self::assertSame(['stringVal' => 'visible'], $model->toArray());
        self::assertSame('{"stringVal":"visible"}', json_encode($model, JSON_THROW_ON_ERROR));
        self::assertSame('{}', json_encode(new TestRootModel, JSON_THROW_ON_ERROR));
    }

    public function test_malformed_array_of_models_is_rejected(): void
    {
        $this->expectException(\TypeError::class);

        (new TestRootModel)->fromArray(['items' => ['not-an-object']]);
    }

    public function test_non_empty_list_is_rejected_where_nested_object_is_expected(): void
    {
        $this->expectException(\TypeError::class);

        (new TestRootModel)->fromArray(['nested' => ['not-an-object']]);
    }

    public function test_non_empty_list_item_is_rejected_in_model_array(): void
    {
        $this->expectException(\TypeError::class);

        (new TestRootModel)->fromArray(['items' => [['not-an-object']]]);
    }

    public function test_empty_decoded_objects_remain_supported(): void
    {
        $model = (new TestRootModel)->fromArray([
            'nested' => [],
            'items' => [[]],
        ]);

        self::assertInstanceOf(TestNestedModel::class, $model->nested);
        self::assertInstanceOf(TestItemModel::class, $model->items[0]);
    }

    public function test_malformed_scalar_list_is_rejected_during_hydration(): void
    {
        $this->expectException(\TypeError::class);

        (new TestRootModel)->fromArray(['listVal' => ['valid', 123]]);
    }

    public function test_malformed_scalar_list_is_rejected_during_serialization(): void
    {
        $model = new TestRootModel;
        $model->listVal = ['valid', false];

        $this->expectException(\TypeError::class);
        $model->toArray();
    }

    public function test_model_lists_require_model_instances_during_serialization(): void
    {
        $model = new TestRootModel;
        $model->items = [['itemId' => 'raw-array']];

        $this->expectException(\TypeError::class);
        $model->toArray();
    }
}

class TestNestedModel extends AbstractModel
{
    public ?string $field = null;
}

class TestItemModel extends AbstractModel
{
    public ?string $itemId = null;
}

class TestRootModel extends AbstractModel
{
    public ?string $stringVal = null;

    public ?int $intVal = null;

    public ?bool $boolVal = null;

    /** @var array<int,string>|null */
    public ?array $listVal = null;

    public ?TestNestedModel $nested = null;

    /** @var TestItemModel[]|null */
    public ?array $items = null;

    protected static array $_typeMap = [
        'items' => TestItemModel::class,
    ];

    protected static array $_scalarArrayTypeMap = [
        'listVal' => 'string',
    ];
}
