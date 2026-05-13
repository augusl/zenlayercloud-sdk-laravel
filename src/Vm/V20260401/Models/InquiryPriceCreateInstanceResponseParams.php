<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class InquiryPriceCreateInstanceResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * InstancePrice 实例价格。
     */
    public ?PriceItem $instancePrice = null;

    /**
     * BandwidthPrice 公网带宽价格。
     *
     * @var PriceItem[]|null
     */
    public ?array $bandwidthPrice = null;

    /**
     * EipPrice 弹性IP价格。
     */
    public ?PriceItem $eipPrice = null;

    /**
     * SystemDiskPrice 系统盘价格。
     */
    public ?PriceItem $systemDiskPrice = null;

    /**
     * DataDiskPrice 数据盘价格。
     */
    public ?PriceItem $dataDiskPrice = null;

    /**
     * DataDiskPrices 每种规格数据盘的价格。
     *
     * @var DataDisk[]|null
     */
    public ?array $dataDiskPrices = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'bandwidthPrice' => PriceItem::class,
        'dataDiskPrices' => DataDisk::class,
    ];
}
