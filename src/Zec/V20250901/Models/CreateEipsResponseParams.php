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
 * CreateEipsResponseParams
 */
class CreateEipsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * EipIds 创建的弹性公网IP ID列表。
     *
     * @var list<string>|null
     */
    public ?array $eipIds = null;

    /**
     * OrderNumber 本次创建的订单编号。
     */
    public ?string $orderNumber = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'eipIds' => 'string',
    ];
}
