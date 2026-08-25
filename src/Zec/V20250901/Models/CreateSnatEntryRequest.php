<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateSnatEntryRequest extends AbstractModel
{
    /**
     * NatGatewayId NAT网关 ID。
     */
    public ?string $natGatewayId = null;

    /**
     * EipIds SNAT规则添加的弹性公网IP集合。
     * 指定的公网IP ID必须属于NAT网关上绑定的公网弹性IP。
     * 为空则代表与该NAT网关绑定的所有的弹性公网IP。
     *
     * @var list<string>|null
     */
    public ?array $eipIds = null;

    /**
     * Cidr 源CIDR网段。
     * 该字段已废弃，请使用`sourceCidrBlocks`。
     */
    public ?string $cidr = null;

    /**
     * SourceCidrBlocks 源CIDR地址段列表。
     * 与`subnetIds`必须指定其中的一种。
     * 如果使用全地址段，指定为`0.0.0.0/0`。
     *
     * @var list<string>|null
     */
    public ?array $sourceCidrBlocks = null;

    /**
     * SubnetIds 指定子网ID集合。
     * 该参数表示该子网内的实例均可以通过`SNAT`规则访问外部网络。
     * 与`sourceCidrBlocks`必须指定其中的一种。
     *
     * @var list<string>|null
     */
    public ?array $subnetIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'eipIds' => 'string',
        'sourceCidrBlocks' => 'string',
        'subnetIds' => 'string',
    ];
}
