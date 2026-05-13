<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ModifyNatGatewayAttributeRequest
 */
class ModifyNatGatewayAttributeRequest extends AbstractModel
{
    /**
     * NatGatewayId NAT网关 ID。
     */
    public ?string $natGatewayId = null;

    /**
     * Name NAT网关的名称。
     * 长度为2～63个字符。
     */
    public ?string $name = null;

    /**
     * SubnetIds NAT网关的子网ID。
     */
    public ?array $subnetIds = null;

    /**
     * IsAllSubnet NAT网关对应的子网是否应用所有子网。
     * 该字段不能和`subnetIds`同时设置。
     */
    public ?bool $isAllSubnet = null;

    /**
     * IcmpReplyEnabled 是否开启ICMP代回。
     */
    public ?bool $icmpReplyEnabled = null;

    /**
     * SecurityGroupId 修改NAT网关绑定的目标安全组ID。
     * 目前一张NAT网关只能关联一个安全组。
     * 指定该字段会解绑NAT网关原来的安全组。
     */
    public ?string $securityGroupId = null;
}
