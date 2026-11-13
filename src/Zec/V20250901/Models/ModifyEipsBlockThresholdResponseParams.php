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
 * ModifyEipsBlockThresholdResponseParams
 */
class ModifyEipsBlockThresholdResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * FailedEips 修改失败的EIP详情列表。
     * 若全部成功则为空。
     *
     * @var list<ModifyEipsBlockThresholdFailedItem>|null
     */
    public ?array $failedEips = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'failedEips' => ModifyEipsBlockThresholdFailedItem::class,
    ];
}
