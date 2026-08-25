<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ResetInstanceRequest extends AbstractModel
{
    /**
     * InstanceId 待操作的虚拟机实例ID。
     */
    public ?string $instanceId = null;

    /**
     * Password 实例登录密码。
     */
    public ?string $password = null;

    /**
     * KeyId 密钥ID。
     */
    public ?string $keyId = null;

    /**
     * ImageId 指定有效的镜像ID。
     */
    public ?string $imageId = null;

    /**
     * InstanceName 实例显示名称。
     */
    public ?string $instanceName = null;

    /**
     * WanName 公网网卡名称。
     */
    public ?string $wanName = null;

    /**
     * LanName 内网网卡名称。
     */
    public ?string $lanName = null;

    /**
     * InitScript 初始化脚本。
     */
    public ?string $initScript = null;
}
