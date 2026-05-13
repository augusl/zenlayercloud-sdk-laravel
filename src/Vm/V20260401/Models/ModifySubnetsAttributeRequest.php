<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifySubnetsAttributeRequest extends AbstractModel
{
    /**
     * SubnetIds 一个或多个待操作的Subnet ID。
     * 可通过DescribeSubnets接口返回值中的SubnetId获取。
     * 每次请求批量Subnet的上限为100。
     */
    public ?array $subnetIds = null;

    /**
     * SubnetName Subnet名称。
     * 范围1到64个字符。
     * 仅支持输入字母、数字、-和英文句点(.)。
     */
    public ?string $subnetName = null;
}
