<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeSnapshotsResponseParams
 */
class DescribeSnapshotsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * TotalCount 满足过滤条件的快照总数。
     */
    public ?int $totalCount = null;

    /**
     * DataSet 返回的快照列表数据。
     *
     * @var SnapshotInfo[]|null
     */
    public ?array $dataSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataSet' => SnapshotInfo::class,
    ];
}
