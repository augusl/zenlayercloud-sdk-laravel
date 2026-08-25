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
 * CreateDisksResponseParams
 */
class CreateDisksResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * DiskIds 创建的云硬盘ID列表。
     *
     * @var list<string>|null
     */
    public ?array $diskIds = null;

    /**
     * OrderNumber 本次创建对应的订单编号。
     */
    public ?string $orderNumber = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'diskIds' => 'string',
    ];
}
