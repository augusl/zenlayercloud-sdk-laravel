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
 * EipGeoInfo 基于DB-IP/ipdata/... 第三方IP数据库服务商查询到的 IP 地理信息结果。
 */
class EipGeoInfo extends AbstractModel
{
    /**
     * MaxMind 从MaxMind查询的地理信息。
     */
    public ?string $maxMind = null;

    /**
     * IpInfo 从IPinfo(ipinfo.io)查询的地理信息。
     */
    public ?string $ipInfo = null;

    /**
     * DbIp 从DB-IP(db-ip.com)查询的地理信息。
     */
    public ?string $dbIp = null;

    /**
     * IpData 从ipData(ipdata.co)查询的地理信息。
     */
    public ?string $ipData = null;

    /**
     * IpGeoLocation 从IpGeoLocation查询的地理信息。
     */
    public ?string $ipGeoLocation = null;

    /**
     * Standard 需要查询EIP的所在的地理信息。
     */
    public ?string $standard = null;

    /**
     * IsConsistent 查询地理信息是否和所在的地理信息一致。
     */
    public ?bool $isConsistent = null;
}
