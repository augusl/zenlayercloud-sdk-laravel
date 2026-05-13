<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeUnmanagedEgressIpsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * TotalCount 满足过滤条件的非托管出口IP总数。
     */
    public ?int $totalCount = null;

    /**
     * DataSet 返回的非托管出口IP列表。
     *
     * @var UnmanagedEgressIpInfo[]|null
     */
    public ?array $dataSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataSet' => UnmanagedEgressIpInfo::class,
    ];
}
