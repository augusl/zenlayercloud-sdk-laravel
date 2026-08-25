<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyEipBlockThresholdRequest extends AbstractModel
{
    /**
     * EipId 修改封堵阈值的EIP ID。
     * 网段（IP块）类型的EIP不支持修改封堵阈值。
     */
    public ?string $eipId = null;

    /**
     * Enable 是否启用自定义封堵阈值。
     * 传`false`时删除已有的自定义阈值，恢复为系统默认阈值，此时无需传递四项阈值。
     */
    public ?bool $enable = null;

    /**
     * Bps 带宽封堵阈值，单位Mbps。
     * 上限由配额`ZEC_EIP_Block_threshold_bps_cap`控制。
     * 启用自定义阈值时，四项阈值至少传一项；未传的项保持原值不变。
     */
    public ?int $bps = null;

    /**
     * Pps 报文速率封堵阈值，单位kpps。
     * 上限由配额`ZEC_EIP_Block_threshold_pps_cap`控制。
     * 启用自定义阈值时，四项阈值至少传一项；未传的项保持原值不变。
     */
    public ?int $pps = null;

    /**
     * InCps 入向连接速率封堵阈值，单位kcps。
     * 上限由配额`ZEC_EIP_Block_threshold_cps_in_cap`控制。
     * 启用自定义阈值时，四项阈值至少传一项；未传的项保持原值不变。
     */
    public ?int $inCps = null;

    /**
     * OutCps 出向连接速率封堵阈值，单位kcps。
     * 上限由配额`ZEC_EIP_Block_threshold_cps_out_cap`控制。
     * 启用自定义阈值时，四项阈值至少传一项；未传的项保持原值不变。
     */
    public ?int $outCps = null;
}
