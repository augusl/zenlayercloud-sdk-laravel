<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeDhcpOptionsSetsRequest extends AbstractModel
{
    /**
     * DhcpOptionsSetIds DHCP 选项集的 ID。
     * 最多支持输入 20 个 DHCP 选项集的 ID。
     */
    public ?array $dhcpOptionsSetIds = null;

    /**
     * DhcpOptionsSetName DHCP 选项集的名称。
     * 该字段支持模糊搜索。
     */
    public ?string $dhcpOptionsSetName = null;

    /**
     * SubnetId 关联的子网 ID。
     */
    public ?string $subnetId = null;

    /**
     * PageSize 返回的分页大小，默认为20，最大为1000。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页数。
     */
    public ?int $pageNum = null;

    /**
     * ResourceGroupId 根据资源组ID过滤。
     */
    public ?string $resourceGroupId = null;

    /**
     * TagKeys 根据标签键进行搜索。
     * 最长不得超过20个标签键。
     */
    public ?array $tagKeys = null;

    /**
     * Tags 根据标签进行搜索。
     * 最长不得超过20个标签。
     *
     * @var Tag[]|null
     */
    public ?array $tags = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'tags' => Tag::class,
    ];
}
