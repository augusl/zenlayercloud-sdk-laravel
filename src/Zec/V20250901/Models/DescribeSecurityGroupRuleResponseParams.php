<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeSecurityGroupRuleResponseParams
 */
class DescribeSecurityGroupRuleResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * IngressRuleList 入方向规则列表。
     *
     * @var SecurityGroupRuleInfo[]|null
     */
    public ?array $ingressRuleList = null;

    /**
     * EgressRuleList 出方向规则列表。
     *
     * @var SecurityGroupRuleInfo[]|null
     */
    public ?array $egressRuleList = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'ingressRuleList' => SecurityGroupRuleInfo::class,
        'egressRuleList' => SecurityGroupRuleInfo::class,
    ];
}
