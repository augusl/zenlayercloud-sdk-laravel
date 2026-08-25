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
 * RebootInstancesRequest
 */
class RebootInstancesRequest extends AbstractModel
{
    /**
     * InstanceIds 待重启虚拟机实例ID列表。
     *
     * @var list<string>|null
     */
    public ?array $instanceIds = null;

    /**
     * ForceReboot 是否强制重启。
     */
    public ?bool $forceReboot = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'instanceIds' => 'string',
    ];
}
