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
 * ReplaceIp 替换的公网IP信息。
 */
class ReplaceIp extends AbstractModel
{
    /**
     * EipId 需要替换的弹性公网IP ID。
     */
    public ?string $eipId = null;

    /**
     * Deprecated: OwnIp 已废弃，请不要使用。
     * OwnIp 原IP地址。
     * 已废弃。
     *
     * @deprecated
     */
    public ?string $ownIp = null;

    /**
     * TargetIp 需要变更的目标IP。
     * 如果未指定，将由系统随机分配。
     * 不能以`.0`或`.255`结尾（网络地址/广播地址不可用）。
     */
    public ?string $targetIp = null;
}
