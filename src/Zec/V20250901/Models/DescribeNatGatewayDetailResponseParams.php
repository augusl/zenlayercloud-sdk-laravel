<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeNatGatewayDetailResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * NatGatewayId NAT网关唯一ID。
     */
    public ?string $natGatewayId = null;

    /**
     * Name NAT网关名称。
     */
    public ?string $name = null;

    /**
     * Snats SNAT网关规则集合。
     *
     * @var list<SnatEntry>|null
     */
    public ?array $snats = null;

    /**
     * Dnats DNAT网关规则集合。
     *
     * @var list<DnatEntry>|null
     */
    public ?array $dnats = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'snats' => SnatEntry::class,
        'dnats' => DnatEntry::class,
    ];
}
