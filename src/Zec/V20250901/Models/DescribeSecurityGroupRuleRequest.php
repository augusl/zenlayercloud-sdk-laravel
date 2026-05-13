<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeSecurityGroupRuleRequest extends AbstractModel
{
    /**
     * SecurityGroupId 安全组ID。
     */
    public ?string $securityGroupId = null;
}
