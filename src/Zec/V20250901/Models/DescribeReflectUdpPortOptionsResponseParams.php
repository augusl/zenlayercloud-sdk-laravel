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
 * DescribeReflectUdpPortOptionsResponseParams
 */
class DescribeReflectUdpPortOptionsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * ReflectUdpPorts 默认UDP反射源端口列表。
     *
     * @var list<ReflectUdpPortPolicy>|null
     */
    public ?array $reflectUdpPorts = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'reflectUdpPorts' => ReflectUdpPortPolicy::class,
    ];
}
