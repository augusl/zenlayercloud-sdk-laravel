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
 * UnassociateEipAddressResponseParams
 */
class UnassociateEipAddressResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * FailedEipIds 操作失败的弹性IP的ID集合。
     *
     * @var list<string>|null
     */
    public ?array $failedEipIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'failedEipIds' => 'string',
    ];
}
