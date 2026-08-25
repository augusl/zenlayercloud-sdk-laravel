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
 * QosPolicyGroupMember QoS策略组成员信息。
 */
class QosPolicyGroupMember extends AbstractModel
{
    /**
     * ResourceId IP 资源的ID。
     */
    public ?string $resourceId = null;

    /**
     * IpType IP类型。
     */
    public ?string $ipType = null;
}
