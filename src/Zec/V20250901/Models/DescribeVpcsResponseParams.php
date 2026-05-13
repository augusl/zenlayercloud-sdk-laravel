<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeVpcsResponseParams
 */
class DescribeVpcsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * TotalCount 匹配筛选条件的vpc总数量。
     */
    public ?int $totalCount = null;

    /**
     * DataSet 返回分页的vpc集合数据。
     *
     * @var VpcInfo[]|null
     */
    public ?array $dataSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataSet' => VpcInfo::class,
    ];
}
