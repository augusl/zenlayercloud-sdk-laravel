<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateByoipRequest
 */
class CreateByoipRequest extends AbstractModel
{
    /**
     * ByoipList 待创建的 BYOIP 列表。
     *
     * @var ByoipCreateItem[]|null
     */
    public ?array $byoipList = null;

    /**
     * MarketingInfo 市场营销相关选项。
     */
    public ?MarketingInfo $marketingInfo = null;

    /**
     * ResourceGroupId 创建后 BYOIP 所在的资源组ID。
     * 如不指定则放入默认资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * Tags 创建 BYOIP 时关联的标签。
     * 注意：关联「标签键」不能重复。
     */
    public ?TagAssociation $tags = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'byoipList' => ByoipCreateItem::class,
    ];
}
