<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeDDosAllEventListRequest
 */
class DescribeDDosAllEventListRequest extends AbstractModel
{
    /**
     * Status 攻击状态。
     */
    public ?string $status = null;

    /**
     * IpAddress 被攻击的IP。
     */
    public ?string $ipAddress = null;

    /**
     * StartTime 攻击开始时间。
     * 时间格式：yyyy-MM-ddTHH:mm:ssZ。
     */
    public ?string $startTime = null;

    /**
     * EndTime 攻击结束时间。
     * 时间格式：yyyy-MM-ddTHH:mm:ssZ。
     */
    public ?string $endTime = null;

    /**
     * PageSize 返回的分页大小。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页数。
     */
    public ?int $pageNum = null;
}
