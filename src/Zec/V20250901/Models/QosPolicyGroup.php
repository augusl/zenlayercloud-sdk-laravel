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
 * QosPolicyGroup QoS策略组信息。
 */
class QosPolicyGroup extends AbstractModel
{
    /**
     * QosPolicyGroupId QoS策略组ID。
     */
    public ?string $qosPolicyGroupId = null;

    /**
     * Name QoS策略组名称。
     */
    public ?string $name = null;

    /**
     * RegionId 地域ID。
     */
    public ?string $regionId = null;

    /**
     * BandwidthLimit 带宽限制，单位Mbps。
     */
    public ?int $bandwidthLimit = null;

    /**
     * RateLimitMode 限速模式。
     */
    public ?string $rateLimitMode = null;

    /**
     * MemberCount 成员数量。
     */
    public ?int $memberCount = null;

    /**
     * Members 成员列表。
     *
     * @var list<QosPolicyGroupMember>|null
     */
    public ?array $members = null;

    /**
     * CreateTime 创建时间。
     */
    public ?string $createTime = null;

    /**
     * ResourceGroup 所属资源组信息。
     */
    public ?ResourceGroupInfo $resourceGroup = null;

    /**
     * Tags 标签列表。
     */
    public ?Tags $tags = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'members' => QosPolicyGroupMember::class,
    ];
}
