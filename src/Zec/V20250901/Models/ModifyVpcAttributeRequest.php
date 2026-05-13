<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ModifyVpcAttributeRequest
 */
class ModifyVpcAttributeRequest extends AbstractModel
{
    /**
     * VpcId VPC的ID。
     */
    public ?string $vpcId = null;

    /**
     * VpcName VPC的名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-/_和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $vpcName = null;

    /**
     * CidrBlock 需要修改的IPv4 CIDR。
     * 需要满足以下4种内网段内(10.0.0.0/9, 10.128.0.0/9, 172.16.0.0/12以及192.168.0.0/16)。
     * 如果VPC存在子网，则修改的CIDR范围必须包含原VPC CIDR。
     * 默认VPC不支持修改。
     */
    public ?string $cidrBlock = null;

    /**
     * EnableIPv6 是否开启IPv6内网CIDR。
     * 当前仅允许打开(`true`)，一旦设置IPv6, 将无法关闭。
     */
    public ?bool $enableIPv6 = null;

    /**
     * SecurityGroupId 修改VPC绑定的安全组ID。
     * 如果不指定，则不会修改。
     */
    public ?string $securityGroupId = null;
}
