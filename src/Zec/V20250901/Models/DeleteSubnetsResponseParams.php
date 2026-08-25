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
 * DeleteSubnetsResponseParams
 */
class DeleteSubnetsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * FailedSubnets 删除失败的子网详情列表。
     * 若全量成功则为空。
     *
     * @var list<DeleteSubnetsFailedItem>|null
     */
    public ?array $failedSubnets = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'failedSubnets' => DeleteSubnetsFailedItem::class,
    ];
}
