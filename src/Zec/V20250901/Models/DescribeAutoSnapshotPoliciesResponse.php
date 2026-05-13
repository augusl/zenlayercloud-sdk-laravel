<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeAutoSnapshotPoliciesResponse extends AbstractModel
{
    public ?string $requestId = null;

    public ?DescribeAutoSnapshotPoliciesResponseParams $response = null;
}
