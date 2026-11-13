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
 * DeleteNetworkInterfacePermissionRequest
 */
class DeleteNetworkInterfacePermissionRequest extends AbstractModel
{
    /**
     * PermissionId 要删除的网卡授权ID。
     * 可通过调用 **DescribeNetworkInterfacePermissions** 获取。
     */
    public ?string $permissionId = null;

    /**
     * Force 被授权账号已把网卡绑定到它的实例时，是否仍然删除授权。
     * 为 `false` 时拒绝删除；删除授权不会解绑网卡。
     */
    public ?bool $force = null;
}
