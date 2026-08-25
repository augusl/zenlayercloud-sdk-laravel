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
 * InterconnectDataCenter 边界网关互联节点关联的数据中心信息。
 */
class InterconnectDataCenter extends AbstractModel
{
    /**
     * DcId 数据中心ID。
     */
    public ?string $dcId = null;

    /**
     * DcCode 数据中心代码。
     */
    public ?string $dcCode = null;

    /**
     * Name 数据中心英文名称。
     */
    public ?string $name = null;

    /**
     * CityName 城市英文名称。
     */
    public ?string $cityName = null;

    /**
     * CountryName 国家英文名称。
     */
    public ?string $countryName = null;
}
