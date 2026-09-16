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
 * CreateByoAsnRequest
 */
class CreateByoAsnRequest extends AbstractModel
{
    /**
     * Asn 待接入的公网ASN号。
     * 支持 2 字节与 4 字节 ASN，最大值 4294967295。
     */
    public ?int $asn = null;

    /**
     * ResourceGroupId 创建后 BYO ASN 所在的资源组ID。
     * 如不指定则放入默认资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * Tags 创建 BYO ASN 时关联的标签。
     * 注意：关联「标签键」不能重复。
     */
    public ?TagAssociation $tags = null;
}
