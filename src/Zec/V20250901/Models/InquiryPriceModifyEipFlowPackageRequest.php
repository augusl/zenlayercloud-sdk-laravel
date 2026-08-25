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
 * InquiryPriceModifyEipFlowPackageRequest
 */
class InquiryPriceModifyEipFlowPackageRequest extends AbstractModel
{
    /**
     * EipId 要操作的公网弹性IP。
     */
    public ?string $eipId = null;

    /**
     * FlowPackage 调整后的流量包大小。
     * 单位：TB，为0或0.1的倍数。
     */
    public ?float $flowPackage = null;
}
