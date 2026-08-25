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
 * ModifyEipAttributeRequest
 */
class ModifyEipAttributeRequest extends AbstractModel
{
    /**
     * EipId 公网弹性IP的ID。
     */
    public ?string $eipId = null;

    /**
     * Name 公网弹性IP的名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-/_和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $name = null;
}
