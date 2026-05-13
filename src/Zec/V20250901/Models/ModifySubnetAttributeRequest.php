<?php

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
     * SubnetName 子网的名称。
     * 仅支持输入字母、数字、-和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $subnetName = null;

    /**
     * CidrBlock 需要修改的IPv4 CIDR Block。
     * 仅支持有IPv4堆栈类型的子网。
     */
    public ?string $cidrBlock = null;
}
