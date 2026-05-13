<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ModifyBorderGatewayAsnRequest
 */
class ModifyBorderGatewayAsnRequest extends AbstractModel
{
    /**
     * ZbgId 要修改的边界网关ID。
     */
    public ?string $zbgId = null;

    /**
     * Asn ASN。
     */
    public ?int $asn = null;
}
