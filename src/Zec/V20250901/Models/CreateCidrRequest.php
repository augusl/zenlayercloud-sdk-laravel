<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateCidrRequest
 */
class CreateCidrRequest extends AbstractModel
{
    /**
     * RegionId 节点ID。
     */
    public ?string $regionId = null;

    /**
     * Deprecated: EipV4Type 已废弃，请不要使用。
     * EipV4Type 公网IPv4的网络类型。
     * 已废弃，请使用`networkLineType`。
     */
    public ?string $eipV4Type = null;

    /**
     * NetworkLineType 公网IPv4的网络类型。
     */
    public ?string $networkLineType = null;

    /**
     * Netmask CIDR掩码、数量。
     */
    public ?NetmaskInfo $netmask = null;

    /**
     * Name CIDR名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-/_和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     * 默认会将分配的CIDR地址作为名称。
     */
    public ?string $name = null;

    /**
     * ResourceGroupId 资源组ID。
     * 如果不指定，则会加入默认资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * MarketingOptions 市场营销相关的选项。
     */
    public ?MarketingInfo $marketingOptions = null;

    /**
     * Tags 创建CIDR时关联的标签。
     * 注意：关联`标签键`不能重复。
     */
    public ?TagAssociation $tags = null;
}
