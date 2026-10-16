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
 * DdosTrafficControl DDoS源限速相关设置
 */
class DdosTrafficControl extends AbstractModel
{
    /**
     * BpsEnabled 是否开启bps限速。
     */
    public ?bool $bpsEnabled = null;

    /**
     * Bps bps限速值。
     */
    public ?int $bps = null;

    /**
     * PpsEnabled 是否开启pps限速。
     */
    public ?bool $ppsEnabled = null;

    /**
     * Pps pps限速值。
     */
    public ?int $pps = null;

    /**
     * SynBPSEnabled 是否开启sync bps限速。
     */
    public ?bool $synBPSEnabled = null;

    /**
     * SynBPS syn bps限速值。
     */
    public ?int $synBPS = null;

    /**
     * SynPPSEnabled 是否开启sync pps限速。
     */
    public ?bool $synPPSEnabled = null;

    /**
     * SynPPS syn pps限速值。
     */
    public ?int $synPPS = null;
}
