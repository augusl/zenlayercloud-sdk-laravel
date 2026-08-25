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
 * BlockInfo ip封堵信息详情
 */
class BlockInfo extends AbstractModel
{
    /**
     * Ip ip。
     */
    public ?string $ip = null;

    /**
     * Bps 单位bps。
     */
    public ?int $bps = null;

    /**
     * Pps 单位pps。
     */
    public ?int $pps = null;

    /**
     * InCps 单位个。
     */
    public ?int $inCps = null;

    /**
     * OutCps 单位个。
     */
    public ?int $outCps = null;

    /**
     * Enable 是否启用特定阈值。
     */
    public ?bool $enable = null;
}
