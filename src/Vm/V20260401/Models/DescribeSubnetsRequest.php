<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeSubnetsRequest extends AbstractModel
{
    /**
     * ZoneId 子网所属的可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * SubnetIds 子网 ID。
     * 取值可以由多个Subnet ID组成一个。
     * 最多支持100个ID查询。
     */
    public ?array $subnetIds = null;

    /**
     * CidrBlock 子网的CIDR。
     * 支持模糊查询。
     */
    public ?string $cidrBlock = null;

    /**
     * SubnetStatus Subnet的状态。
     */
    public ?string $subnetStatus = null;

    /**
     * SubnetName 子网的名称。
     * 支持模糊查询。
     */
    public ?string $subnetName = null;

    /**
     * PageSize 返回的分页大小。
     * 默认为20，最大为1000。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页数。
     * 默认为1。
     */
    public ?int $pageNum = null;
}
