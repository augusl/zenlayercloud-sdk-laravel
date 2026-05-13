<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InquiryPricePublicIpv6Request
 */
class InquiryPricePublicIpv6Request extends AbstractModel
{
    /**
     * RegionId 节点ID。
     */
    public ?string $regionId = null;

    /**
     * PackageSize 流量包订购大小。
     * 单位为TB。
     */
    public ?float $packageSize = null;

    /**
     * Bandwidth 公网出带宽上限。
     * 单位：Mbps。
     * 不同机型带宽上限范围不一致，具体限制详见购买网络带宽。
     */
    public ?int $bandwidth = null;
}
