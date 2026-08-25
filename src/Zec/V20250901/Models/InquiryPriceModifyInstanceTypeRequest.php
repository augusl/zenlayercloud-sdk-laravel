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
 * InquiryPriceModifyInstanceTypeRequest
 */
class InquiryPriceModifyInstanceTypeRequest extends AbstractModel
{
    /**
     * InstanceId 要变更规格的实例ID。
     */
    public ?string $instanceId = null;

    /**
     * InstanceType 变更的目标实例规格。普通实例取值可通过[DescribeZoneInstanceConfigInfos](describezoneinstanceconfiginfos.md)获得；GPU 实例取值可通过[DescribeZoneGpuInstanceConfigInfos](describezonegpuinstanceconfiginfos.md)获得。
     */
    public ?string $instanceType = null;
}
