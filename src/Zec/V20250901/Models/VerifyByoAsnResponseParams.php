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
 * VerifyByoAsnResponseParams
 */
class VerifyByoAsnResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * ByoAsnId BYO ASN的ID。
     */
    public ?string $byoAsnId = null;

    /**
     * Asn ASN号。
     */
    public ?int $asn = null;

    /**
     * Status 校验后的状态。
     * `AVAILABLE`表示归属确认通过，该ASN已可用于创建BYOIP；仍为`VERIFYING`表示尚未检测到export声明，可稍后重试。
     */
    public ?string $status = null;

    /**
     * VerifyCode 校验码。
     * 需要客户将其写入RIR上该ASN的aut-num对象。
     */
    public ?string $verifyCode = null;

    /**
     * ExportDeclaration 完整的export声明语句。
     * 客户直接复制该语句写入RIR上该ASN的aut-num对象即可。
     */
    public ?string $exportDeclaration = null;
}
