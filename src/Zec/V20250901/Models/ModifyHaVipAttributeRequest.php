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
 * ModifyHaVipAttributeRequest
 */
class ModifyHaVipAttributeRequest extends AbstractModel
{
    /**
     * HaVipId 高可用虚拟IP的ID。
     * 可通过调用 ~~DescribeHaVips~~ 获取。
     */
    public ?string $haVipId = null;

    /**
     * Name HaVip名称。
     * 长度1到64个字符。
     * name与securityGroupId至少提供一个。
     */
    public ?string $name = null;

    /**
     * SecurityGroupId 安全组ID。
     * 若设置，则将HaVip绑定的安全组修改为指定安全组。
     * name与securityGroupId至少提供一个。
     * 可通过调用 ~~DescribeSecurityGroups~~ 获取。
     */
    public ?string $securityGroupId = null;
}
