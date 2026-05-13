<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateDnatEntryResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * DnatEntryId DNAT规则唯一ID。
     */
    public ?string $dnatEntryId = null;
}
