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
 * ReleaseInstancesRequest
 */
class ReleaseInstancesRequest extends AbstractModel
{
    /**
     * InstanceIds 要释放的实例ID列表。
     *
     * @var list<string>|null
     */
    public ?array $instanceIds = null;

    /**
     * DependResource 释放实例时是否同步释放关联资源。
     * true：同步释放（默认）；false：仅释放实例本身，关联资源保留。
     */
    public ?bool $dependResource = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'instanceIds' => 'string',
    ];
}
