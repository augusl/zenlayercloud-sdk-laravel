<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ModifySubnetsAttributeRequest
 */
class ModifySubnetsAttributeRequest extends AbstractModel
{
    /**
     * SubnetIds 需要修改的子网ID列表。
     */
    public ?array $subnetIds = null;

    /**
     * Name 修改的子网名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-/_和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $name = null;
}
