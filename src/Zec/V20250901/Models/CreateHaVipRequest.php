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
 * CreateHaVipRequest
 */
class CreateHaVipRequest extends AbstractModel
{
    /**
     * SubnetId HaVip所属子网ID。
     */
    public ?string $subnetId = null;

    /**
     * Name HaVip名称。
     * 长度1到64个字符。
     */
    public ?string $name = null;

    /**
     * IpAddress 指定HaVip的私网IP地址。
     * 不填时系统自动分配。
     */
    public ?string $ipAddress = null;

    /**
     * SecurityGroupId 安全组ID。
     * 不填时使用VPC默认安全组。
     */
    public ?string $securityGroupId = null;

    /**
     * Tags 创建HaVip时关联的标签。
     */
    public ?TagAssociation $tags = null;
}
