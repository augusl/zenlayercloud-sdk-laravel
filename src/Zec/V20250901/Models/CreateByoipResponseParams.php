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
 * CreateByoipResponseParams
 */
class CreateByoipResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * RpkiFailedList RPKI 校验失败的 BYOIP 列表。
     *
     * @var list<string>|null
     */
    public ?array $rpkiFailedList = null;

    /**
     * IrrFailedList IRR 校验失败的 BYOIP 列表。
     *
     * @var list<string>|null
     */
    public ?array $irrFailedList = null;

    /**
     * ByoipIds 创建成功的 BYOIP ID 列表。
     *
     * @var list<string>|null
     */
    public ?array $byoipIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'rpkiFailedList' => 'string',
        'irrFailedList' => 'string',
        'byoipIds' => 'string',
    ];
}
