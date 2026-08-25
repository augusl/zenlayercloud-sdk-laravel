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
 * CreateAutoSnapshotPolicyRequest
 */
class CreateAutoSnapshotPolicyRequest extends AbstractModel
{
    /**
     * ZoneId 可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * AutoSnapshotPolicyName 自动快照策略的名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-/_和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
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
     * 默认为永久保存。
     * 取值范围：-1或[1,65535]。
     */
    public ?int $retentionDays = null;

    /**
     * ResourceGroupId 资源组ID。
     */
    public ?string $resourceGroupId = null;

    /**
     * Tags 创建自动快照时关联的标签。
     * 注意：·关联`标签键`不能重复。
     */
    public ?TagAssociation $tags = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'repeatWeekDays' => 'int',
        'hours' => 'int',
    ];
}
