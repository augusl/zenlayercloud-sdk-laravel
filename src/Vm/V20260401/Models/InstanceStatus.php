<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InstanceStatus 描述实例的状态。
 */
class InstanceStatus extends AbstractModel
{
    /**
     * PENDING 待创建
     */
    public ?string $PENDING = null;

    /**
     * DEPLOYING 部署中
     */
    public ?string $DEPLOYING = null;

    /**
     * REBUILDING 重建中。
     */
    public ?string $REBUILDING = null;

    /**
     * REBOOT 重启中
     */
    public ?string $REBOOT = null;

    /**
     * RUNNING 运行中。
     */
    public ?string $RUNNING = null;

    /**
     * STOPPED 关机的。
     */
    public ?string $STOPPED = null;

    /**
     * BOOTING 启动中。
     */
    public ?string $BOOTING = null;

    /**
     * RELEASING 删除释放中。
     */
    public ?string $RELEASING = null;

    /**
     * STOPPING 关机中。
     */
    public ?string $STOPPING = null;

    /**
     * RECYCLE 已删除，回收保留中。
     */
    public ?string $RECYCLE = null;

    /**
     * RECYCLING 回收中。
     */
    public ?string $RECYCLING = null;

    /**
     * CREATE_FAILED 创建失败。
     */
    public ?string $CREATE_FAILED = null;

    /**
     * IMAGING 镜像制作中。
     */
    public ?string $IMAGING = null;
}
