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
 * ModifyIPTransitsAttributeRequest
 */
class ModifyIPTransitsAttributeRequest extends AbstractModel
{
    /**
     * IptIds IP Transit ID 列表。
     * 最多支持 100 个。
     *
     * @var list<string>|null
     */
    public ?array $iptIds = null;

    /**
     * IptName IP Transit名称。
     */
    public ?string $iptName = null;

    /**
     * IptDescription IP Transit描述。
     */
    public ?string $iptDescription = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'iptIds' => 'string',
    ];
}
