<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateZecInstancesResponseParams
 */
class CreateZecInstancesResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * OrderNumber 订单编号。
     */
    public ?string $orderNumber = null;

    /**
     * InstanceIdSet 虚拟机实例ID列表。
     */
    public ?array $instanceIdSet = null;

    /**
     * Instances 随机器创建的数据盘id集合。
     * 如果请求中没有指定数据盘，返回空数组。
     *
     * @var DiskWithInstance[]|null
     */
    public ?array $instances = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'instances' => DiskWithInstance::class,
    ];
}
