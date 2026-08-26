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
 * BgpConfigParam BGP 变配参数。
 */
class BgpConfigParam extends AbstractModel
{
    /**
     * RouteType BGP inbound 路由类型。
     * type=BGP_ROUTE_TYPE 时必填。
     */
    public ?string $routeType = null;

    /**
     * AsnList ASN 列表。
     * type=BGP_ASN_AS_SET 时与 `asSetList` 二选一。
     * `asn` 创建后不支持修改。
     *
     * @var list<int>|null
     */
    public ?array $asnList = null;

    /**
     * AsSetList AS-SET 列表。
     * type=BGP_ASN_AS_SET 时与 `asnList` 二选一。
     * `asn` 创建后不支持修改。
     *
     * @var list<string>|null
     */
    public ?array $asSetList = null;

    /**
     * Password BGP MD5 密码（长度 8–64）。
     * type=BGP_PASSWORD 时必填。
     */
    public ?string $password = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'asnList' => 'int',
        'asSetList' => 'string',
    ];
}
