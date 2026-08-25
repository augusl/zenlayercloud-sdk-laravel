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
 * ModifySubnetAttributeRequest
 */
class ModifySubnetAttributeRequest extends AbstractModel
{
    /**
     * SubnetId 子网的ID。
     */
    public ?string $subnetId = null;

    /**
     * SubnetName 子网名称。
     * 该参数必须以数字或字母开头和结尾，仅支持字母、数字、连字符(-)和英文句点(.)。
     */
    public ?string $subnetName = null;

    /**
     * CidrBlock 需要修改的IPv4 CIDR Block。
     * 仅支持有IPv4堆栈类型的子网。
     */
    public ?string $cidrBlock = null;
}
