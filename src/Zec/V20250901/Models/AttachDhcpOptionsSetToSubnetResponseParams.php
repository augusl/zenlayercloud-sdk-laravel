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
 * AttachDhcpOptionsSetToSubnetResponseParams
 */
class AttachDhcpOptionsSetToSubnetResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * FailedSubnetIds 操作失败的subnet ID集合。
     *
     * @var list<string>|null
     */
    public ?array $failedSubnetIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'failedSubnetIds' => 'string',
    ];
}
