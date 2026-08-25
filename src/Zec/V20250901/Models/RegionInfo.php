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
 * RegionInfo 节点信息。
 */
class RegionInfo extends AbstractModel
{
    /**
     * RegionId 节点ID。
     */
    public ?string $regionId = null;

    /**
     * RegionName 节点名称。
     */
    public ?string $regionName = null;

    /**
     * RegionTitle 节点标题。
     */
    public ?string $regionTitle = null;

    /**
     * EnablePubIpv6 是否支持IPv6。
     */
    public ?bool $enablePubIpv6 = null;
}
