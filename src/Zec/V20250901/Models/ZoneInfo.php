<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ZoneInfo 可用区的基本信息。
 */
class ZoneInfo extends AbstractModel
{
    /**
     * ZoneId 可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * RegionId 可用区所在的节点ID。
     */
    public ?string $regionId = null;

    /**
     * ZoneName 可用区名称。
     */
    public ?string $zoneName = null;

    /**
     * Deprecated: SupportSecurityGroup 已废弃，请不要使用。
     * SupportSecurityGroup 可用区是否支持安全组。
     * 该字段已废弃，当前所有节点均支持安全组。
     */
    public ?bool $supportSecurityGroup = null;

    /**
     * TimeZone 可用区所在的时区。
     */
    public ?string $timeZone = null;

    /**
     * CityName 可用区所在的城市名称。
     */
    public ?string $cityName = null;

    /**
     * CityCode 城市三字码。
     */
    public ?string $cityCode = null;

    /**
     * CountryCode 可用区所在的国家，ISO 3166-1 alpha-2 两字母代码（如 US、JP）。
     */
    public ?string $countryCode = null;

    /**
     * CountryName 可用区所在的国家名称。
     */
    public ?string $countryName = null;
}
