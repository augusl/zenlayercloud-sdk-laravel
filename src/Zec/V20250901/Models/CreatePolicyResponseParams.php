<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreatePolicyResponseParams
 */
class CreatePolicyResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * PolicyId 防护策略ID。
     */
    public ?string $policyId = null;
}
