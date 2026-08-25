<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * VpcInfo 描述VPC的基本信息。
 */
class VpcInfo extends AbstractModel
{
    /**
     * VpcId VPC的ID。
     */
    public ?string $vpcId = null;

    /**
     * Name VPC的名称。
     */
    public ?string $name = null;

    /**
     * CidrBlock VPC的IPv4 CIDR。
     */
    public ?string $cidrBlock = null;

    /**
     * Ipv6CidrBlock VPC的内网IPv6 CIDR。
     * 如果为null,说明未开启IPv6。
     */
    public ?string $ipv6CidrBlock = null;

    /**
     * Mtu VPC的MTU（最大传输单元），单位字节。
     */
    public ?int $mtu = null;

    /**
     * IsDefault 是否为默认VPC。
     */
    public ?bool $isDefault = null;

    /**
     * CreateTime 创建时间。
     */
    public ?string $createTime = null;

    /**
     * UsageIpv4Count VPC内已分配的IPv4地址数量。
     */
    public ?int $usageIpv4Count = null;

    /**
     * UsageIpv6Count VPC内已分配的IPv6地址数量。
     */
    public ?int $usageIpv6Count = null;

    /**
     * SecurityGroupId 关联的安全组ID。
     */
    public ?string $securityGroupId = null;

    /**
     * DnsZoneIds VPC关联的DNS内网权威域名ID。
     *
     * @var list<string>|null
     */
    public ?array $dnsZoneIds = null;

    /**
     * ResourceGroup VPC关联的资源组信息。
     */
    public ?ResourceGroupInfo $resourceGroup = null;

    /**
     * Tags 该VPC关联的标签。
     */
    public ?Tags $tags = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'dnsZoneIds' => 'string',
    ];
}
