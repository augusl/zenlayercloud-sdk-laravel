<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateByoipResponseParams
 */
class CreateByoipResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * RpkiFailedList RPKI 校验失败的 BYOIP 列表。
     */
    public ?array $rpkiFailedList = null;

    /**
     * IrrFailedList IRR 校验失败的 BYOIP 列表。
     */
    public ?array $irrFailedList = null;

    /**
     * ByoipIds 创建成功的 BYOIP ID 列表。
     */
    public ?array $byoipIds = null;
}
