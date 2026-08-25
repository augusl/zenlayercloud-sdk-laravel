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
 * ChangeNicNetworkTypeRequest
 */
class ChangeNicNetworkTypeRequest extends AbstractModel
{
    /**
     * InstanceId 待操作的实例ID。
     */
    public ?string $instanceId = null;

    /**
     * NicNetworkType 要更改的网卡模式。
     */
    public ?string $nicNetworkType = null;
}
