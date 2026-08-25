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
 * DescribeEipRemoteRegionsResponseParams
 */
class DescribeEipRemoteRegionsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * PeerRegionIds 支持的远端的节点ID列表。
     *
     * @var list<string>|null
     */
    public ?array $peerRegionIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'peerRegionIds' => 'string',
    ];
}
