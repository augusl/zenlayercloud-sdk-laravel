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
 * PlacementGroupInfo 描述置放组的详细信息。
 */
class PlacementGroupInfo extends AbstractModel
{
    /**
     * PlacementGroupId 置放组ID。
     */
    public ?string $placementGroupId = null;

    /**
     * Name 置放组名称。
     */
    public ?string $name = null;

    /**
     * ZoneId 置放组所属可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * PartitionNum 置放组的分区数。
     * 取值范围为2到5，决定置放组最大可关联实例数。
     */
    public ?int $partitionNum = null;

    /**
     * Affinity 置放组的亲和度。
     * 取值范围为1到分区数向下取整除以2。
     */
    public ?int $affinity = null;

    /**
     * InstanceCount 置放组内的实例数量。
     */
    public ?int $instanceCount = null;

    /**
     * InstanceIds 置放组内关联的实例ID列表。
     *
     * @var list<string>|null
     */
    public ?array $instanceIds = null;

    /**
     * ConstraintStatus 置放组约束满足状态。
     */
    public ?string $constraintStatus = null;

    /**
     * CreateTime 置放组的创建时间。
     */
    public ?string $createTime = null;

    /**
     * ResourceGroup 置放组所属的资源组信息。
     */
    public ?ResourceGroupInfo $resourceGroup = null;

    /**
     * Tags 置放组的标签。
     */
    public ?Tags $tags = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'instanceIds' => 'string',
    ];
}
