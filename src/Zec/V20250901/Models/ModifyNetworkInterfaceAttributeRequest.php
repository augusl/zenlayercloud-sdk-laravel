<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ModifyNetworkInterfaceAttributeRequest
 */
class ModifyNetworkInterfaceAttributeRequest extends AbstractModel
{
    /**
     * NicId 需要修改的网卡ID。
     */
    public ?string $nicId = null;

    /**
     * Name 名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-/_和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $name = null;

    /**
     * SecurityGroupId 修改网卡绑定的目标安全组ID。
     * 目前一张网卡只能关联一个安全组。
     * 指定该字段会解绑网卡原来的安全组。
     */
    public ?string $securityGroupId = null;
}
