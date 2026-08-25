<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateSubnetRequest extends AbstractModel
{
    /**
     * CidrBlock 子网的CIDR。
     * 可选值10.0.0.0/16、172.16.0.0/16和192.168.0.0/16及它们包含的子网。
     * 子网网段不能重叠。
     */
    public ?string $cidrBlock = null;

    /**
     * SubnetName 子网的名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $subnetName = null;

    /**
     * SubnetDescription 子网的描述信息。
     */
    public ?string $subnetDescription = null;

    /**
     * ZoneId 子网的节点ID。
     */
    public ?string $zoneId = null;
}
