<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeIpv6CidrsResponseParams
 */
class DescribeIpv6CidrsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * TotalCount 符合条件的数据总数。
     */
    public ?int $totalCount = null;

    /**
     * DataSet 查询IPV6 CIDR地址的结果数据。
     *
     * @var Ipv6CidrInfo[]|null
     */
    public ?array $dataSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataSet' => Ipv6CidrInfo::class,
    ];
}
