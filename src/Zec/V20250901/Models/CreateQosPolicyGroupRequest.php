<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateQosPolicyGroupRequest extends AbstractModel
{
    /**
     * RegionId QoS策略组所在地域ID。
     */
    public ?string $regionId = null;

    /**
     * Name QoS策略组名称。
     * 长度不能超过64个字符。
     */
    public ?string $name = null;

    /**
     * BandwidthLimit 带宽限制，单位Mbps。
     * 最大不得超过100000000 Mbps。
     */
    public ?int $bandwidthLimit = null;

    /**
     * RateLimitMode 限速模式。
     */
    public ?string $rateLimitMode = null;

    /**
     * ResourceGroupId 资源组ID。
     * 不填则加入默认资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * Tags 标签列表。
     */
    public ?TagAssociation $tags = null;
}
