<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Facades;

use Illuminate\Support\Facades\Facade;
use ZenlayerCloud\Laravel\Vm\V20260401\VmClient;
use ZenlayerCloud\Laravel\Zec\V20250901\ZecClient;
use ZenlayerCloud\Laravel\ZenlayerCloudManager;

/**
 * @method static VmClient vm(?string $connection = null)
 * @method static ZecClient zec(?string $connection = null)
 * @method static void flushClients()
 *
 * @see ZenlayerCloudManager
 */
class ZenlayerCloud extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ZenlayerCloudManager::class;
    }
}
