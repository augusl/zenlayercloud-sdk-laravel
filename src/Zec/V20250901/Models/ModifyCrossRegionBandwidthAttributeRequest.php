<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ModifyCrossRegionBandwidthAttributeRequest
 */
class ModifyCrossRegionBandwidthAttributeRequest extends AbstractModel
{
    /**
     * CrossRegionBandwidthIds 要修改的内网跨区域带宽ID集合。
     */
    public ?array $crossRegionBandwidthIds = null;

    /**
     * CrossRegionBandwidthName 内网跨区域带宽的名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-/_和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $crossRegionBandwidthName = null;
}
