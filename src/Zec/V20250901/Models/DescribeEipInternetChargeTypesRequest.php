<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeEipInternetChargeTypesRequest
 */
class DescribeEipInternetChargeTypesRequest extends AbstractModel
{
    /**
     * RegionId 查询的节点ID。
     */
    public ?string $regionId = null;

    /**
     * Deprecated: EipV4Type 已废弃，请不要使用。
     * EipV4Type EIP IP线路类型。
     * 已废弃，请使用`networkLineType`。
     */
    public ?string $eipV4Type = null;

    /**
     * NetworkLineType EIP IP线路类型。
     */
    public ?string $networkLineType = null;
}
