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
 * CreatePlacementGroupRequest
 */
class CreatePlacementGroupRequest extends AbstractModel
{
    /**
     * ZoneId 置放组所属可用区ID。
     * 置放组的管理范围为zone维度。
     */
    public ?string $zoneId = null;

    /**
     * Name 置放组名称。
     * 长度2到63个字符。
     * 必须以字母或数字开头和结尾，支持字母、数字、空格、连字符、斜杠、点号。
     */
    public ?string $name = null;

    /**
     * PartitionNum 置放组的分区数。
     * 最小是2，默认为3。
     * 决定置放组最大可关联实例数。
     */
    public ?int $partitionNum = null;

    /**
     * Affinity 置放组的亲和度。
     * 取值范围为1到分区数向下取整除以2。
     * 不填时默认为分区数向下取整除以2。
     */
    public ?int $affinity = null;

    /**
     * ResourceGroupId 资源组ID。
     */
    public ?string $resourceGroupId = null;

    /**
     * Tags 创建置放组时关联的标签。
     */
    public ?TagAssociation $tags = null;
}
