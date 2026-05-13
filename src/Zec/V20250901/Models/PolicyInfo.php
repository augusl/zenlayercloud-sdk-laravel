<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * PolicyInfo 描述防护策略的信息。
 */
class PolicyInfo extends AbstractModel
{
    /**
     * PolicyId 防护策略唯一ID。
     */
    public ?string $policyId = null;

    /**
     * PolicyName 防护策略名称。
     */
    public ?string $policyName = null;

    /**
     * CreateTime 创建时间。
     */
    public ?string $createTime = null;

    /**
     * ResourceGroupId 防护策略所属的资源组ID。
     */
    public ?string $resourceGroupId = null;

    /**
     * ResourceGroupName 防护策略所属的资源组名称。
     */
    public ?string $resourceGroupName = null;

    /**
     * Tags 防护策略关联的标签。
     */
    public ?Tags $tags = null;
}
