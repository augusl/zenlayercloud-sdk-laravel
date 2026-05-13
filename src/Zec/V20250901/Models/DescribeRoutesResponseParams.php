<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeRoutesResponseParams
 */
class DescribeRoutesResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * TotalCount 符合条件的数据总数。
     */
    public ?int $totalCount = null;

    /**
     * DataSet 路由列表数据。
     *
     * @var RouteInfo[]|null
     */
    public ?array $dataSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataSet' => RouteInfo::class,
    ];
}
