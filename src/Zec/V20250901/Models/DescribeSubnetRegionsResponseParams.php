<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeSubnetRegionsResponseParams
 */
class DescribeSubnetRegionsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * RegionSet 支持子网的节点信息。
     *
     * @var RegionInfo[]|null
     */
    public ?array $regionSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'regionSet' => RegionInfo::class,
    ];
}
