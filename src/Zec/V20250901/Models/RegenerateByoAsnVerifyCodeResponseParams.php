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
 * RegenerateByoAsnVerifyCodeResponseParams
 */
class RegenerateByoAsnVerifyCodeResponseParams extends AbstractModel
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
     * Status 重新生成校验码后的状态，回到`VERIFYING`。
     */
    public ?string $status = null;

    /**
     * VerifyCode 新的校验码。
     * 旧校验码立即失效，需要客户将新校验码写入RIR上该ASN的aut-num对象。
     */
    public ?string $verifyCode = null;

    /**
     * ExportDeclaration 完整的export声明语句。
     * 客户直接复制该语句更新RIR上该ASN的aut-num对象即可。
     */
    public ?string $exportDeclaration = null;
}
