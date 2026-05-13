<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ReplaceEipAddressRequest
 */
class ReplaceEipAddressRequest extends AbstractModel
{
    /**
     * ReplaceIps 需要替换的弹性公网IP信息。
     *
     * @var ReplaceIp[]|null
     */
    public ?array $replaceIps = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'replaceIps' => ReplaceIp::class,
    ];
}
