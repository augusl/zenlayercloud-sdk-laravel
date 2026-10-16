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
 * ModifyInstanceTypeRequest
 */
class ModifyInstanceTypeRequest extends AbstractModel
{
    /**
     * InstanceId 要变更的实例ID。
     * 可通过调用 ~~DescribeInstances~~ 获取。
     */
    public ?string $instanceId = null;

    /**
     * InstanceType 变更的目标实例规格。
     * 普通实例取值可通过 ~~DescribeZoneInstanceConfigInfos~~ 获得；GPU实例取值可通过 ~~DescribeZoneGpuInstanceConfigInfos~~ 获得。
     */
    public ?string $instanceType = null;
}
