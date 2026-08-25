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
 * DdosPolicyPort DDoS端口封禁规则。
 */
class DdosPolicyPort extends AbstractModel
{
    /**
     * Protocol 协议类型。
     * 只支持 `UDP` / `TCP` 两种协议。
     */
    public ?string $protocol = null;

    /**
     * SrcPortStart 源端口范围的起始值。
     */
    public ?int $srcPortStart = null;

    /**
     * SrcPortEnd 源端口范围的结束值。
     */
    public ?int $srcPortEnd = null;

    /**
     * DstPortStart 目的端口范围的起始值。
     */
    public ?int $dstPortStart = null;

    /**
     * DstPortEnd 目的端口范围的结束值。
     */
    public ?int $dstPortEnd = null;

    /**
     * Action 匹配后的动作。
     */
    public ?string $action = null;
}
