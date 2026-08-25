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
 * StopInstancesRequest
 */
class StopInstancesRequest extends AbstractModel
{
    /**
     * InstanceIds 待关闭的实例ID。
     *
     * @var list<string>|null
     */
    public ?array $instanceIds = null;

    /**
     * ForceShutdown 是否强制关机。
     */
    public ?bool $forceShutdown = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'instanceIds' => 'string',
    ];
}
