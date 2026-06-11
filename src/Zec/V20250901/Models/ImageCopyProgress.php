<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ImageCopyProgress 描述自定义镜像在单个目标区域的复制进度。
 */
class ImageCopyProgress extends AbstractModel
{
    /**
     * DestRegionId 目标区域 ID。
     */
    public ?string $destRegionId = null;

    /**
     * DestRegionName 目标区域名称。
     */
    public ?string $destRegionName = null;

    /**
     * SyncStage 复制阶段。
     */
    public ?string $syncStage = null;

    /**
     * Queued 是否处于排队等待中，传输任务正在等待系统调度执行。
     */
    public ?bool $queued = null;

    /**
     * SyncPercent 复制进度百分比，保留2位小数（如74.23）。
     */
    public ?float $syncPercent = null;

    /**
     * ErrorInfo 该目标区域复制异常或失败时返回的错误信息。
     */
    public ?string $errorInfo = null;
}
