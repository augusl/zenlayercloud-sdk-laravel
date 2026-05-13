<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeNatGatewaysResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * TotalCount 满足过滤条件的NAT网关总数。
     */
    public ?int $totalCount = null;

    /**
     * DataSet 返回的NAT网关列表。
     *
     * @var NatGateway[]|null
     */
    public ?array $dataSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataSet' => NatGateway::class,
    ];
}
