<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DeleteDnatEntryRequest extends AbstractModel
{
    /**
     * DnatEntryId DNAT规则 ID。
     */
    public ?string $dnatEntryId = null;
}
