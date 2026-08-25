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
 * DeleteSubnetsFailedItem 批量删除子网中单个失败项的详情。
 */
class DeleteSubnetsFailedItem extends AbstractModel
{
    /**
     * SubnetId 删除失败的子网ID。
     */
    public ?string $subnetId = null;

    /**
     * ErrorCode 错误码。
     */
    public ?string $errorCode = null;

    /**
     * ErrorMsg 错误消息。
     */
    public ?string $errorMsg = null;
}
