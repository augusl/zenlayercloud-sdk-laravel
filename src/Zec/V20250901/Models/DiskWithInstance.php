<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DiskWithInstance 随机器创建的数据盘信息。
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
