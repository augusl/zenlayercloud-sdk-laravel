<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * FlowPackageResponseItem 流量包明细。
 */
class FlowPackageResponseItem extends AbstractModel
{
    /**
     * TrafficType 流量方向类型。
     * LOCAL：境内；INTERNATIONAL：境外；ALL：全部方向。
     */
    public ?string $trafficType = null;

    /**
     * FlowPackage 该方向的流量包大小，单位 TB。
     */
    public ?float $flowPackage = null;
}
