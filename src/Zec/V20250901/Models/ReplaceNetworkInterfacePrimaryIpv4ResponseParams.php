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
 * ReplaceNetworkInterfacePrimaryIpv4ResponseParams
 */
class ReplaceNetworkInterfacePrimaryIpv4ResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * NicId 网卡ID。
     */
    public ?string $nicId = null;

    /**
     * PrimaryIpAddress 变更后生效的主内网IPv4地址。
     */
    public ?string $primaryIpAddress = null;
}
