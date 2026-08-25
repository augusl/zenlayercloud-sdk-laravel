<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * Tag 描述一个标签键值对的信息。
 */
class Tag extends AbstractModel
{
    /**
     * Key 标签键。
     * 长度限制：1～64个字符。
     */
    public ?string $key = null;

    /**
     * Value 标签值。
     * 长度限制：1～64个字符。
     */
    public ?string $value = null;
}
