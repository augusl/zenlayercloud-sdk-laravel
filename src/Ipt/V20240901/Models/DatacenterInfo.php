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
 * DatacenterInfo 数据中心的基本信息。
 */
class DatacenterInfo extends AbstractModel
{
    /**
     * DcId 数据中心ID。
     */
    public ?string $dcId = null;

    /**
     * DcName 数据中心名称。
     */
    public ?string $dcName = null;

    /**
     * DcAddress 数据中心地址。
     */
    public ?string $dcAddress = null;

    /**
     * CityName 数据中心所在城市名称。
     */
    public ?string $cityName = null;

    /**
     * CountryName 数据中心所在国家名称。
     */
    public ?string $countryName = null;

    /**
     * AreaName 数据中心所在区域名称。
     */
    public ?string $areaName = null;

    /**
     * Latitude 数据中心所在地纬度。
     */
    public ?float $latitude = null;

    /**
     * Longitude 数据中心所在地经度。
     */
    public ?float $longitude = null;
}
