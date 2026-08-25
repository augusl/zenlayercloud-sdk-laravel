<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifySnatEntryRequest extends AbstractModel
{
    /**
     * SnatEntryId SNAT规则 ID。
     */
    public ?string $snatEntryId = null;

    /**
     * EipIds SNAT规则添加的弹性公网IP ID集合。
     * 如果需要修改为NAT网关所有上弹性公网IP，请指定`isAllEip`=`true`。
     *
     * @var list<string>|null
     */
    public ?array $eipIds = null;

    /**
     * IsAllEip 弹性公网IP是否为所有的NAT网关上的公网弹性IP。
     */
    public ?bool $isAllEip = null;

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
     * SubnetIds 要修改子网ID集合。
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
