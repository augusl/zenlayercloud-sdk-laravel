<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ModifyEipBandwidthRequest
 */
class ModifyEipBandwidthRequest extends AbstractModel
{
    /**
     * EipId EIP唯一标识ID。
     */
    public ?string $eipId = null;

    /**
     * Bandwidth 调整带宽限速的目标值。
     * 单位Mbps。
     */
    public ?int $bandwidth = null;

    /**
     * CommitBandwidth 保底带宽。
     * 单位Mbps。
     * 有且仅当为Remote IP，且为选择带宽包计费, 需要指定专线部分的保底带宽。
     */
    public ?int $commitBandwidth = null;
}
