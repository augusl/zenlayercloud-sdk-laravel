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
 * AttachNetworkInterfaceRequest
 */
class AttachNetworkInterfaceRequest extends AbstractModel
{
    /**
     * NicId 需要操作的网卡ID。
     * 可通过调用 ~~DescribeNetworkInterfaces~~ 获取。
     */
    public ?string $nicId = null;

    /**
     * InstanceId 需要绑定的实例ID。
     * 可通过调用 ~~DescribeInstances~~ 获取。
     */
    public ?string $instanceId = null;
}
