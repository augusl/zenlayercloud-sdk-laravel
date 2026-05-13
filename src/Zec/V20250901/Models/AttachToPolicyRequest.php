<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * AttachToPolicyRequest
 */
class AttachToPolicyRequest extends AbstractModel
{
    /**
     * PolicyId 防护策略ID。
     */
    public ?string $policyId = null;

    /**
     * Ipv4IdList 防护对象列表。
     */
    public ?array $ipv4IdList = null;
}
