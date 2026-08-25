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
 * SnatEntry 描述SNAT规则的信息。
 */
class SnatEntry extends AbstractModel
{
    /**
     * SnatEntryId SNAT规则 ID。
     */
    public ?string $snatEntryId = null;

    /**
     * Cidrs CIDR网段，不传默认是0.0.0.0/0。
     * `cidrs` 和 `snatSubnets` 不会同时存在。
     *
     * @var list<string>|null
     */
    public ?array $cidrs = null;

    /**
     * EipIds SNAT规则添加的弹性公网IP ID集合。
     *
     * @var list<string>|null
     */
    public ?array $eipIds = null;

    /**
     * IsAllEip 弹性公网IP是否为所有的NAT网关上的公网弹性IP。
     */
    public ?bool $isAllEip = null;

    /**
     * SnatSubnets SNAT规则添加的subnet ID集合。
     *
     * @var list<SnatSubnet>|null
     */
    public ?array $snatSubnets = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'snatSubnets' => SnatSubnet::class,
    ];

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'cidrs' => 'string',
        'eipIds' => 'string',
    ];
}
