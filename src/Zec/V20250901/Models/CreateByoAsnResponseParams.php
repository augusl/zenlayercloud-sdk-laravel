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
 * CreateByoAsnResponseParams
 */
class CreateByoAsnResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * ByoAsnId 新建 BYO ASN 的ID。
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
     * CreateTime 创建时间。
     */
    public ?string $createTime = null;
}
