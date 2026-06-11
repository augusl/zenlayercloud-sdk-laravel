<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InquiryPriceResizeDiskRequest
 */
class InquiryPriceResizeDiskRequest extends AbstractModel
{
    /**
     * DiskId 云硬盘ID。
     */
    public ?string $diskId = null;

    /**
     * DiskSize 云硬盘扩容后的目标大小。
     * 单位：GiB。
     */
    public ?int $diskSize = null;
}
