<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * AttackEventInfo 攻击事件的信息。
 */
class AttackEventInfo extends AbstractModel
{
    /**
     * EventId 攻击事件唯一ID。
     */
    public ?string $eventId = null;

    /**
     * Status 攻击状态。
     */
    public ?string $status = null;

    /**
     * IpAddress 被攻击的IP。
     */
    public ?string $ipAddress = null;

    /**
     * Protecting IP是否正在防护中。
     */
    public ?bool $protecting = null;

    /**
     * StartTime 攻击开始时间。
     */
    public ?string $startTime = null;

    /**
     * EndTime 攻击结束时间。
     */
    public ?string $endTime = null;

    /**
     * EndBlackholeTime 从黑洞解封时间。
     */
    public ?string $endBlackholeTime = null;

    /**
     * AttackBandwidthMax 攻击峰值流量。
     * 单位bps。
     */
    public ?float $attackBandwidthMax = null;

    /**
     * AttackPackageMax 攻击峰值包量。
     * 单位pps。
     */
    public ?float $attackPackageMax = null;

    /**
     * RegionId 事件发生所在区域ID。
     */
    public ?string $regionId = null;
}
