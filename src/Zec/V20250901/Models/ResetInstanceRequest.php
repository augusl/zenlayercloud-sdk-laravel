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
 * ResetInstanceRequest
 */
class ResetInstanceRequest extends AbstractModel
{
    /**
     * InstanceId 要重装的实例ID。
     * 可通过调用 ~~DescribeInstances~~ 获取。
     */
    public ?string $instanceId = null;

    /**
     * Password 实例的新密码。
     * 与keyId必须指定其中的一种（Windows和Generic类型的镜像无法指定密码和key）。
     * 必须同时包含以下3类字符：大小写字母（a-z、A-Z）、数字（0-9）、特殊字符（~!@$^*-_=+）。
     */
    public ?string $password = null;

    /**
     * KeyId 密钥ID。
     * 与password必须指定其中的一种（Windows和Generic类型的镜像无法指定密码和key）。
     * 可调用 ~~ccs:DescribeKeyPairs~~ 来获得最新的密钥对信息。
     * 关联密钥后，就可以通过对应的私钥来访问实例；密钥与密码不能同时指定，同时Windows操作系统不支持指定密钥。
     * 示例值：key-YWD2QFOl。
     */
    public ?string $keyId = null;

    /**
     * ImageId 指定重装的镜像ID。
     * 可以通过调用 ~~DescribeImages~~ 从返回的imageId字段获取。
     * 如果不指定，会根据当前镜像进行重装。
     */
    public ?string $imageId = null;

    /**
     * Timezone 操作系统时区设置。
     */
    public ?string $timezone = null;

    /**
     * EnableAgent 是否启用QEMU Guest代理(QGA)。
     */
    public ?bool $enableAgent = null;

    /**
     * InstanceName 修改的实例名称。
     * 2～63个字符。
     * 仅支持输入字母、数字、英文句点(.)、下划线(_)、斜杠(/)和连字符(-)，且必须以字母或数字开头和结尾。
     */
    public ?string $instanceName = null;

    /**
     * UserData 实例初始化自定义脚本，需使用Base64编码后传入，解码后大小需小于64KiB。
     */
    public ?string $userData = null;
}
