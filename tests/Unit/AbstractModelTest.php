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

    public function test_to_json_preserves_unicode_unescaped(): void
    {
        $req = new TestRootModel;
        $req->stringVal = '测试';

        self::assertSame('{"stringVal":"测试"}', $req->toJson());
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
}
