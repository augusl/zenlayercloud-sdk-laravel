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
 * DeletePlacementGroupsResponseParams
 */
class DeletePlacementGroupsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * FailedPlacementGroupIds 删除失败的置放组ID列表。
     * 若全量成功则为空。
     *
     * @var list<string>|null
     */
    public ?array $failedPlacementGroupIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'failedPlacementGroupIds' => 'string',
    ];
}
