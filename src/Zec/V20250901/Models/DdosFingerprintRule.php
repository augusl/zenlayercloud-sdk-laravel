<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DdosFingerprintRule DDoS 指纹过滤的相关配置
 */
class DdosFingerprintRule extends AbstractModel
{
    /**
     * Protocol 设置指纹的协议。
     */
    public ?string $protocol = null;

    /**
     * SrcPortStart 指纹源端口的范围起始值。
     */
    public ?int $srcPortStart = null;

    /**
     * SrcPortEnd 指纹源端口的范围结束值。
     */
    public ?int $srcPortEnd = null;

    /**
     * DstPortStart 指纹目的端口的范围起始值。
     */
    public ?int $dstPortStart = null;

    /**
     * DstPortEnd 指纹目的端口的范围结束值。
     */
    public ?int $dstPortEnd = null;

    /**
     * MinPktLength 需要过滤出的最小包长。
     */
    public ?int $minPktLength = null;

    /**
     * MaxPktLength 需要过滤出的最大包长。
     */
    public ?int $maxPktLength = null;

    /**
     * Offset 报文载荷特征的偏移量。
     * TCP/UDP payload 的偏移 [0-1500]。
     */
    public ?int $offset = null;

    /**
     * MatchBytes 检测载荷。
     * 不含0x 的16进制 小写 补足2位。
     */
    public ?string $matchBytes = null;

    /**
     * Action 设置指纹匹配后的动作。
     */
    public ?string $action = null;
}
