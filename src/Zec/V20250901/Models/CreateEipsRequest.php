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
 * CreateEipsRequest
 */
class CreateEipsRequest extends AbstractModel
{
    /**
     * RegionId 创建EIP所在的节点ID。
     */
    public ?string $regionId = null;

    /**
     * Name EIP的名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-/_和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $name = null;

    /**
     * InternetChargeType 公网弹性IP的网络计费方式。
     */
    public ?string $internetChargeType = null;

    /**
     * Amount 需要创建EIP的数量。
     */
    public ?int $amount = null;

    /**
     * PrefixLength 掩码长度，取值范围24–32，默认32。
     * 指定小于32时，将创建EIP Block资源，此时必须同时指定`cidrId`，且取值不能小于所选CIDR自身的掩码长度。
     */
    public ?int $prefixLength = null;

    /**
     * Deprecated: EipV4Type 已废弃，请不要使用。
     * EipV4Type 公网弹性IP的线路类型。
     * 已废弃，请使用`networkLineType`。
     *
     * @deprecated
     */
    public ?string $eipV4Type = null;

    /**
     * NetworkLineType 公网弹性IP的线路类型。
     */
    public ?string $networkLineType = null;

    /**
     * Deprecated: PrimaryIsp 已废弃，请不要使用。
     * PrimaryIsp 主公网IP的运营商。
     *
     * @deprecated
     */
    public ?string $primaryIsp = null;

    /**
     * Bandwidth 公网弹性IP的带宽限速。
     * 单位：Mbps。
     */
    public ?int $bandwidth = null;

    /**
     * CidrId 指定CIDR ID，使用CIDR内分配弹性IP。
     * 该字段和`eipV4Type`不能同时指定。
     */
    public ?string $cidrId = null;

    /**
     * PublicIp 指定公网起始地址开始创建弹性IP。
     * 不指定`cidrId`时，从公网IP池按此地址开始顺序分配（仅支持`prefixLength`为32）；指定`cidrId`时，从该CIDR内按此地址开始分配。
     * `prefixLength`为32时填纯IPv4地址；`prefixLength`小于32时必须同时指定`cidrId`，填带掩码的起始网段（掩码须与`prefixLength`一致，如`88.0.5.64/26`）。
     */
    public ?string $publicIp = null;

    /**
     * ResourceGroupId 弹性公网IP所放的资源组ID，如不指定则放入默认资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * FlowPackage 弹性公网IP的流量包大小。
     * 单位为TB。
     * 值要求为0或0.1的倍数。
     * 当网络计费方式为流量计费(`ByTrafficPackage`)时需要指定。
     */
    public ?float $flowPackage = null;

    /**
     * ClusterId 共享带宽包ID。
     * 当网络计费方式为共享带宽包计费(`BandwidthCluster`)时需要指定。
     */
    public ?string $clusterId = null;

    /**
     * PeerRegionId 远端的节点ID。
     */
    public ?string $peerRegionId = null;

    /**
     * MarketingOptions 市场营销的相关选项。
     */
    public ?MarketingInfo $marketingOptions = null;

    /**
     * Tags 弹性公网IP绑定的标签。
     * 注意：实例关联`标签键`不能重复。
     */
    public ?TagAssociation $tags = null;

    /**
     * InstanceId is the instance to bind all newly created EIPs to. When both `instanceId` and `instanceIds` are supplied, `instanceId` takes precedence. Documented at https://docs.console.zenlayer.com/api-reference/compute/zec/elastic-ip/createeips
     */
    public ?string $instanceId = null;

    /**
     * InstanceIds 要绑定的实例ID集合。
     * 数量需要与`amount`字段一致。
     *
     * @var list<string>|null
     */
    public ?array $instanceIds = null;

    /**
     * BindType 绑定类型。
     * 当指定`instanceIds`时生效。
     * 默认为普通NAT模式。
     */
    public ?string $bindType = null;

    /**
     * RateLimitMode 限速模式。
     * `STRICT`严格模式必须同时指定`bandwidth`。
     */
    public ?string $rateLimitMode = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'instanceIds' => 'string',
    ];
}
