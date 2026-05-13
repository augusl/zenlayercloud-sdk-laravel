<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DiskWithInstance 实例与关联的云盘信息。
 */
class DiskWithInstance extends AbstractModel
{
    /**
     * InstanceId 实例ID。
     */
    public ?string $instanceId = null;

    /**
     * DiskIdSet 随机器创建的数据盘ID集合。
     */
    public ?array $diskIdSet = null;
}
