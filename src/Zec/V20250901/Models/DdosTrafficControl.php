<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DdosTrafficControl DDoS源限速相关设置
 */
class DdosTrafficControl extends AbstractModel
{
    /**
     * BpsEnabled 是否开启 bps 限速。
     */
    public ?bool $bpsEnabled = null;

    /**
     * Bps bps 限速值。
     */
    public ?int $bps = null;

    /**
     * PpsEnabled 是否开启 pps 限速。
     */
    public ?bool $ppsEnabled = null;

    /**
     * Pps pps 限速值。
     */
    public ?int $pps = null;

    /**
     * SynBPSEnabled 是否开启 sync bps 限速。
     */
    public ?bool $synBPSEnabled = null;

    /**
     * SynBPS syn bps 限速值。
     */
    public ?int $synBPS = null;

    /**
     * SynPPSEnabled 是否开启 sync pps 限速。
     */
    public ?bool $synPPSEnabled = null;

    /**
     * SynPPS syn pps 限速值。
     */
    public ?int $synPPS = null;
}
