<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreatePolicyRequest
 */
class CreatePolicyRequest extends AbstractModel
{
    /**
     * PolicyName 防护策略的名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $policyName = null;

    /**
     * ResourceGroupId 创建后防护策略所在的资源组ID，如不指定则放入默认资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * BlackIpList 黑名单列表。
     */
    public ?array $blackIpList = null;

    /**
     * WhiteIpList 白名单列表。
     */
    public ?array $whiteIpList = null;

    /**
     * IpBlackTimeout 黑名单超时时间, 单位:分钟。
     */
    public ?int $ipBlackTimeout = null;

    /**
     * Ports 端口封禁, 支持TCP和UDP。
     *
     * @var DdosPolicyPort[]|null
     */
    public ?array $ports = null;

    /**
     * BlockProtocol 开启的封禁协议。
     * 不能同时开启UDP和TCP。
     */
    public ?array $blockProtocol = null;

    /**
     * BlockRegions 封禁的区域。
     */
    public ?array $blockRegions = null;

    /**
     * Finger 指纹过滤相关配置。
     *
     * @var DdosFingerprintRule[]|null
     */
    public ?array $finger = null;

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
     * Tags 创建DDoS时关联的标签。
     * 注意：·关联`标签键`不能重复。
     */
    public ?TagAssociation $tags = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'ports' => DdosPolicyPort::class,
        'finger' => DdosFingerprintRule::class,
        'reflectUdpPort' => DdosReflectUdpPort::class,
    ];
}
