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
 * CreateNetworkInterfaceResponseParams
 */
class CreateNetworkInterfaceResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * NicId 创建的辅助网卡ID。
     */
    public ?string $nicId = null;
}
