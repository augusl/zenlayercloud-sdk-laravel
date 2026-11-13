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
 * AttachDhcpOptionsSetToSubnetRequest
 */
class AttachDhcpOptionsSetToSubnetRequest extends AbstractModel
{
    /**
     * DhcpOptionsSetId DHCP选项集ID。
     * 可通过调用 **DescribeDhcpOptionsSets** 获取。
     */
    public ?string $dhcpOptionsSetId = null;

    /**
     * SubnetIds 要与DHCP选项集关联的子网ID集合。
     * 可通过调用 **DescribeSubnets** 获取。
     *
     * @var list<string>|null
     */
    public ?array $subnetIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'subnetIds' => 'string',
    ];
}
