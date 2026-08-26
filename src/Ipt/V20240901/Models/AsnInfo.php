<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Ipt\V20240901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * AsnInfo 可用 ASN 信息。
 */
class AsnInfo extends AbstractModel
{
    /**
     * Asn ASN 值。
     */
    public ?string $asn = null;

    /**
     * AsnType ASN 类型。
     */
    public ?string $asnType = null;
}
