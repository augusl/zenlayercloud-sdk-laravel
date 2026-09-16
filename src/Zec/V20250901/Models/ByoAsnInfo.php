<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ByoAsnInfo BYO ASN 信息。
 */
class ByoAsnInfo extends AbstractModel
{
    /**
     * ByoAsnId BYO ASN 的ID。
     */
    public ?string $byoAsnId = null;

    /**
     * Asn ASN号。
     */
    public ?int $asn = null;

    /**
     * Status 当前状态。
     */
    public ?string $status = null;

    /**
     * Type 来源类型。
     */
    public ?string $type = null;

    /**
     * VerifyCode 校验码。
     * 需要客户将其写入 RIR 上该ASN的 aut-num 对象。
     */
    public ?string $verifyCode = null;

    /**
     * ExportDeclaration 完整的 export 声明语句。
     * 客户直接复制该语句写入 RIR 上该ASN的 aut-num 对象即可。
     */
    public ?string $exportDeclaration = null;

    /**
     * Ipv4CidrCount 该ASN下已宣告的IPv4 CIDR数量。
     */
    public ?int $ipv4CidrCount = null;

    /**
     * Ipv6CidrCount 该ASN下已宣告的IPv6 CIDR数量。
     */
    public ?int $ipv6CidrCount = null;

    /**
     * CreateTime 创建时间。
     */
    public ?string $createTime = null;

    /**
     * ResourceGroup 所属资源组信息。
     */
    public ?ResourceGroupInfo $resourceGroup = null;

    /**
     * Tags 标签列表。
     */
    public ?Tags $tags = null;
}
