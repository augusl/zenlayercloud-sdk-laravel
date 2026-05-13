<?php

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
     */
    public ?array $peerRegionIds = null;
}
