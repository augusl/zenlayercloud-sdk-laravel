<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateVpcRequest
 */
class CreateVpcRequest extends AbstractModel
{
    /**
     * Name VPC的名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $name = null;

    /**
     * CidrBlock VPC的CIDR地址段。
     * 需要满足以下4种内网段内(10.0.0.0/9, 10.128.0.0/9, 172.16.0.0/12以及192.168.0.0/16)。
     */
    public ?string $cidrBlock = null;

    /**
     * Mtu VPC的传输单元 MTU。
     * 支持：1300、1500、9000。
     */
    public ?int $mtu = null;

    /**
     * EnablePriIpv6 是否开启内网IPv6。
     * 一旦开启，后续无法关闭。
     * 默认为关闭。
     */
    public ?bool $enablePriIpv6 = null;

    /**
     * ResourceGroupId VPC所在的资源组ID。
     * 如果不指定资源组，则会放到默认的资源组中。
     */
    public ?string $resourceGroupId = null;

    /**
     * Tags 创建VPC时关联的标签。
     * 注意：·关联`标签键`不能重复。
     */
    public ?TagAssociation $tags = null;
}
