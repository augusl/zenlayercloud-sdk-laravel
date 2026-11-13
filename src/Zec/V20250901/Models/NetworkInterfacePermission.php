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
 * NetworkInterfacePermission 网卡授权信息。
 */
class NetworkInterfacePermission extends AbstractModel
{
    /**
     * PermissionId 网卡授权ID。
     */
    public ?string $permissionId = null;

    /**
     * NicId 网卡ID。
     */
    public ?string $nicId = null;

    /**
     * GranteeCid 被授权账号的cid。
     */
    public ?string $granteeCid = null;

    /**
     * Permission 授权的操作。
     */
    public ?string $permission = null;

    /**
     * CreateTime 授权的创建时间。
     */
    public ?string $createTime = null;
}
