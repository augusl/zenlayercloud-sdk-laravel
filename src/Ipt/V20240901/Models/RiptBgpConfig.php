<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Ipt\V20240901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * RiptBgpConfig BGP相关配置
 */
class RiptBgpConfig extends AbstractModel
{
    /**
     * RouteType 入站路由类型。
     */
    public ?string $routeType = null;

    /**
     * Asn 宣告出站路由的ASN号。
     */
    public ?int $asn = null;

    /**
     * Password 加密认证秘钥。
     */
    public ?string $password = null;

    /**
     * AsnList 宣告出站路由的ASN号列表。
     *
     * @var list<int>|null
     */
    public ?array $asnList = null;

    /**
     * AsSetList 宣告出站路由的AS-SET列表。
     *
     * @var list<string>|null
     */
    public ?array $asSetList = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'asnList' => 'int',
        'asSetList' => 'string',
    ];
}
