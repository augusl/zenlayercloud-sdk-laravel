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
 * ModifyNetworkInterfacesAttributeRequest
 */
class ModifyNetworkInterfacesAttributeRequest extends AbstractModel
{
    /**
     * NicIds 需要修改的网卡ID列表。
     *
     * @var list<string>|null
     */
    public ?array $nicIds = null;

    /**
     * Name 名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-/_和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $name = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'nicIds' => 'string',
    ];
}
