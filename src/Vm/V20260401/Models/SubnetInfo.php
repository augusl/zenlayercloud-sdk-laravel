<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * SubnetInfo 子网信息。
 */
class SubnetInfo extends AbstractModel
{
    /**
     * SubnetId Subnet的ID。
     */
    public ?string $subnetId = null;

    /**
     * ZoneId Subnet的机房ID。
     */
    public ?string $zoneId = null;

    /**
     * SubnetName Subnet的名称。
     */
    public ?string $subnetName = null;

    /**
     * SubnetStatus Subnet的状态。
     */
    public ?string $subnetStatus = null;

    /**
     * CidrBlockList Subnet的CIDR列表。
     *
     * @var list<string>|null
     */
    public ?array $cidrBlockList = null;

    /**
     * UsageIpCount Subnet的已用IP数。
     */
    public ?int $usageIpCount = null;

    /**
     * TotalIpCount Subnet的总IP数。
     */
    public ?int $totalIpCount = null;

    /**
     * CreateTime Subnet的创建时间。
     */
    public ?string $createTime = null;

    /**
     * InstanceIdList Subnet下绑定的实例列表。
     *
     * @var list<string>|null
     */
    public ?array $instanceIdList = null;

    /**
     * SubnetDescription Subnet的描述信息。
     */
    public ?string $subnetDescription = null;

    /**
     * CidrBlock Subnet的CIDR。
     */
    public ?string $cidrBlock = null;

    /**
     * IsDefault Subnet是否为默认。
     */
    public ?bool $isDefault = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'cidrBlockList' => 'string',
        'instanceIdList' => 'string',
    ];
}
