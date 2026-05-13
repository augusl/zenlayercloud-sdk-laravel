<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyBorderGatewaysAttributeRequest extends AbstractModel
{
    /**
     * ZbgIds 边界网关的ID列表。
     */
    public ?array $zbgIds = null;

    /**
     * Name 边界网关的名称。
     */
    public ?string $name = null;

    /**
     * RoutingMode 路由级别。
     */
    public ?string $routingMode = null;

    /**
     * AdvertisedSubnet 子网控制。
     */
    public ?string $advertisedSubnet = null;

    /**
     * AdvertisedCidrs IPv4 Cidr集合。
     */
    public ?array $advertisedCidrs = null;

    /**
     * Asn 边界网关的ASN。
     */
    public ?int $asn = null;
}
