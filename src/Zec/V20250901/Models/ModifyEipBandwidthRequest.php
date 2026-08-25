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
 * ModifyEipBandwidthRequest
 */
class ModifyEipBandwidthRequest extends AbstractModel
{
    /**
     * EipId EIP唯一标识ID。
     */
    public ?string $eipId = null;

    /**
     * Bandwidth 调整带宽限速的目标值。
     * 单位Mbps。
     */
    public ?int $bandwidth = null;

    /**
     * Deprecated: CommitBandwidth 已废弃，请不要使用。
     * CommitBandwidth 已废弃，该参数不再生效，传值将被忽略。
     * 已配置突发带宽的 EIP 保持原值不变；若本次 `bandwidth` 超过原突发带宽，突发带宽将自动上调至与 `bandwidth` 一致。
     *
     * @deprecated
     */
    public ?int $commitBandwidth = null;
}
