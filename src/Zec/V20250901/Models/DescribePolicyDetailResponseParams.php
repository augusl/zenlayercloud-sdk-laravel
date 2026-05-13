<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribePolicyDetailResponseParams
 */
class DescribePolicyDetailResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * PolicyId 防护策略的ID。
     */
    public ?string $policyId = null;

    /**
     * PolicyName 防护策略的名称。
     */
    public ?string $policyName = null;

    /**
     * AttachmentIps 防护对象关联IP列表。
     */
    public ?array $attachmentIps = null;

    /**
     * CreateTime 创建时间。
     */
    public ?string $createTime = null;

    /**
     * BlackIps 黑名单IP列表。
     */
    public ?array $blackIps = null;

    /**
     * WhiteIps 白名单IP列表。
     */
    public ?array $whiteIps = null;

    /**
     * BlackIpListExpireAt 黑名单超时时间。
     */
    public ?int $blackIpListExpireAt = null;

    /**
     * BlockProtocols 开启的封禁协议。
     * 不能同时开启UDP和TCP。
     */
    public ?array $blockProtocols = null;

    /**
     * Ports 端口封禁。
     *
     * @var DdosPolicyPort[]|null
     */
    public ?array $ports = null;

    /**
     * BlockRegions 封禁的区域。
     */
    public ?array $blockRegions = null;

    /**
     * ReflectUdpPort 反射攻击防护过滤的端口列表。
     *
     * @var DdosReflectUdpPort[]|null
     */
    public ?array $reflectUdpPort = null;

    /**
     * TrafficControl 源限速配置。
     */
    public ?DdosTrafficControl $trafficControl = null;

    /**
     * FingerPrintRules 指纹过滤相关配置。
     *
     * @var DdosFingerprintRule[]|null
     */
    public ?array $fingerPrintRules = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'ports' => DdosPolicyPort::class,
        'reflectUdpPort' => DdosReflectUdpPort::class,
        'fingerPrintRules' => DdosFingerprintRule::class,
    ];
}
