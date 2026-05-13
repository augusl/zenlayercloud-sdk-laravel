<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DeleteCidrsRequest extends AbstractModel
{
    /**
     * CidrIds 要删除的cidrId列表。
     */
    public ?array $cidrIds = null;
}
