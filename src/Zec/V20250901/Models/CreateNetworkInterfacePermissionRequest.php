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
 * CreateNetworkInterfacePermissionRequest
 */
class CreateNetworkInterfacePermissionRequest extends AbstractModel
{
    /**
     * NicId 要授权的网卡ID。
     * 可通过调用 **DescribeNetworkInterfaces** 获取。
     * 不支持主网卡，网卡状态须为 `AVAILABLE`。
     */
    public ?string $nicId = null;

    /**
     * GranteeCid 被授权账号的cid，不能是网卡所属账号。
     * 一张网卡只能授权给一个账号；对同一账号重复授权同一操作时，返回已有的授权。
     */
    public ?string $granteeCid = null;

    /**
     * Permission 授权的操作。
     */
    public ?string $permission = null;
}
