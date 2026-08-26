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
 * BFDConfig BFD配置。
 */
class BFDConfig extends AbstractModel
{
    /**
     * BfdTxInterval 发送间隔。
     * 单位：ms。
     * 取值范围：100～60000。
     */
    public ?int $bfdTxInterval = null;

    /**
     * BfdRxInterval 接收间隔。
     * 单位：ms
     * 取值范围：100～60000。
     */
    public ?int $bfdRxInterval = null;

    /**
     * BfdMultiplier 本地检测倍数。
     * 取值范围：3～20。
     */
    public ?int $bfdMultiplier = null;
}
