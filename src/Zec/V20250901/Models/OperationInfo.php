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
 * OperationInfo 操作详情。
 */
class OperationInfo extends AbstractModel
{
    /**
     * Operation 操作动作。取值范围：`ModifyBandwidth`（调整带宽）、`ModifyFlowPackage`（调整流量包）。
     */
    public ?string $operation = null;

    /**
     * Status 操作状态。取值范围：`OPERATING`（操作中）、`FAILED`（操作失败）。
     */
    public ?string $status = null;
}
