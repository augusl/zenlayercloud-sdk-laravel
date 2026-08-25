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
 * AutoSnapshotPolicy 描述自动快照策略的相关信息。
 */
class AutoSnapshotPolicy extends AbstractModel
{
    /**
     * AutoSnapshotPolicyId 自动快照策略ID。
     */
    public ?string $autoSnapshotPolicyId = null;

    /**
     * ZoneId 可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * AutoSnapshotPolicyName 自动快照策略的名称。
     */
    public ?string $autoSnapshotPolicyName = null;

    /**
     * RepeatWeekDays 自动快照的重复日期。
     * 单位为天，周期为星期，例如 1 表示周一。
     *
     * @var list<int>|null
     */
    public ?array $repeatWeekDays = null;

    /**
     * Hours 指定定期快照策略的触发时间。
     * 使用 UTC 时间，单位为小时。
     * 00:00 ~ 23:00 共 24 个时间点可选，1表示 01:00，依此类推。
     *
     * @var list<int>|null
     */
    public ?array $hours = null;

    /**
     * RetentionDays 自动快照的保留时间，单位为天。
     * 如果该值设置-1，则代表永久保留。
     * 取值范围：-1或[1,65535]。
     */
    public ?int $retentionDays = null;

    /**
     * DiskNum 关联的云盘数量。
     */
    public ?int $diskNum = null;

    /**
     * CreateTime 策略创建时间。
     */
    public ?string $createTime = null;

    /**
     * ResourceGroup 资源组信息。
     */
    public ?ResourceGroupInfo $resourceGroup = null;

    /**
     * DiskIdSet 关联的云盘ID。
     *
     * @var list<string>|null
     */
    public ?array $diskIdSet = null;

    /**
     * Tags 自动快照策略关联的标签。
     */
    public ?Tags $tags = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'repeatWeekDays' => 'int',
        'hours' => 'int',
        'diskIdSet' => 'string',
    ];
}
