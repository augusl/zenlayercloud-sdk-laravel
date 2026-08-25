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
 * AvailableLanIpResponseParams
 */
class AvailableLanIpResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * LanIps 可与指定 EIP 绑定的 vNIC 与内网 IP 组合列表。
     *
     * @var list<PrivateIpInfo>|null
     */
    public ?array $lanIps = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'lanIps' => PrivateIpInfo::class,
    ];
}
