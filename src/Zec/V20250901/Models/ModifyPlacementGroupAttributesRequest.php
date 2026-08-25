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
 * ModifyPlacementGroupAttributesRequest
 */
class ModifyPlacementGroupAttributesRequest extends AbstractModel
{
    /**
     * PlacementGroupId 置放组ID。
     */
    public ?string $placementGroupId = null;

    /**
     * Name 置放组新名称。
     * 长度2到63个字符。
     * 必须以字母或数字开头和结尾，支持字母、数字、空格、连字符、斜杠、点号。
     */
    public ?string $name = null;

    /**
     * PartitionNum 置放组的分区数。
     * 取值范围为2到5。
     * 分区数只能调大，不能调小。
     * 若修改后的分区数或亲和度不满足当前实例分布状态，会拒绝修改。
     */
    public ?int $partitionNum = null;

    /**
     * Affinity 置放组的亲和度。
     * 取值范围为1到分区数向下取整除以2。
     */
    public ?int $affinity = null;
}
