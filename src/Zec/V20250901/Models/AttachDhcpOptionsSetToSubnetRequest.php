<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class AttachDhcpOptionsSetToSubnetRequest extends AbstractModel
{
    /**
     * DhcpOptionsSetId DHCP 选项集ID。
     */
    public ?string $dhcpOptionsSetId = null;

    /**
     * SubnetIds 要与 DHCP 选项集关联的 Subnet 的 ID集合。
     *
     * @var list<string>|null
     */
    public ?array $subnetIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'subnetIds' => 'string',
    ];
}
