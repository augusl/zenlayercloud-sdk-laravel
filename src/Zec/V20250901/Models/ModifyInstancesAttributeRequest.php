<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ModifyInstancesAttributeRequest
 */
class ModifyInstancesAttributeRequest extends AbstractModel
{
    /**
     * InstanceIds 待修改属性的实例ID列表。
     */
    public ?array $instanceIds = null;

    /**
     * InstanceName 实例名称。
     * 2～63个字符。
     * 仅支持输入字母、数字、-和英文句点(.)。
     */
    public ?string $instanceName = null;
}
