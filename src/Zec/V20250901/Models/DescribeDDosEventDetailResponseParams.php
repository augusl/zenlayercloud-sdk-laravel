<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeDDosEventDetailResponseParams
 */
class DescribeDDosEventDetailResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * EventId 攻击事件唯一ID。
     */
    public ?string $eventId = null;

    /**
     * Status 攻击状态。
     */
    public ?string $status = null;

    /**
     * Type 攻击类型。
     */
    public ?string $type = null;

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
     * AttackBandwidthMax 攻击带宽峰值。
     * 单位bps。
     */
    public ?float $attackBandwidthMax = null;

    /**
     * ProtectedBandwidthMax 防护带宽峰值。
     * 单位bps。
     */
    public ?float $protectedBandwidthMax = null;

    /**
     * AttackPackageMax 攻击峰值包速率。
     * 单位pps。
     */
    public ?float $attackPackageMax = null;

    /**
     * ProtectedPackageMax 防护峰值包速率。
     * 单位pps。
     */
    public ?float $protectedPackageMax = null;

    /**
     * SourceIp 攻击来源IP。
     *
     * @var list<string>|null
     */
    public ?array $sourceIp = null;

    /**
     * SourcePort 攻击来源端口。
     *
     * @var list<TopPort>|null
     */
    public ?array $sourcePort = null;

    /**
     * DesertionPort 攻击目标端口。
     *
     * @var list<TopPort>|null
     */
    public ?array $desertionPort = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'sourcePort' => TopPort::class,
        'desertionPort' => TopPort::class,
    ];

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'sourceIp' => 'string',
    ];
}
