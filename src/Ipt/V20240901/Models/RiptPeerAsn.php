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
 * RiptPeerAsn BGP 档位与 Zenlayer 侧（对端）AS 号的对应关系。
 */
class RiptPeerAsn extends AbstractModel
{
    /**
     * Tier BGP 档位。
     */
    public ?string $tier = null;

    /**
     * Asn 该档位对应的 Zenlayer 侧（对端）AS 号。
     */
    public ?int $asn = null;
}
