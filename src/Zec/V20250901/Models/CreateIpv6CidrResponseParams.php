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
 * CreateIpv6CidrResponseParams
 */
class CreateIpv6CidrResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * CidrIds 创建的IPv6 CIDR地址段ID列表。
     *
     * @var list<string>|null
     */
    public ?array $cidrIds = null;

    /**
     * OrderNumber 本次购买生成的订单号。
     */
    public ?string $orderNumber = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'cidrIds' => 'string',
    ];
}
