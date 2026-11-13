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
 * ModifyEipsBlockThresholdFailedItem 批量修改弹性公网IP封堵阈值中单个失败项的详情。
 */
class ModifyEipsBlockThresholdFailedItem extends AbstractModel
{
    /**
     * EipId 修改失败的EIP ID。
     */
    public ?string $eipId = null;

    /**
     * ErrorCode 错误码。
     */
    public ?string $errorCode = null;

    /**
     * ErrorMsg 错误消息。
     */
    public ?string $errorMsg = null;
}
