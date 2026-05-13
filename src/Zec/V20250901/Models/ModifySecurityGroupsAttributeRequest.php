<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ModifySecurityGroupsAttributeRequest
 */
class ModifySecurityGroupsAttributeRequest extends AbstractModel
{
    /**
     * SecurityGroupName 安全组名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-和英文句点(.)。
     */
    public ?string $securityGroupName = null;

    /**
     * SecurityGroupIds 要操作的安全组ID列表。
     */
    public ?array $securityGroupIds = null;
}
