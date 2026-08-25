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
 * DetachDisksRequest
 */
class DetachDisksRequest extends AbstractModel
{
    /**
     * DiskIds 要卸载的云盘ID列表。
     *
     * @var list<string>|null
     */
    public ?array $diskIds = null;

    /**
     * InstanceCheckFlag 是否检测实例的运行状态。
     * 默认为true，即实例关机才允许被卸载。
     * 否则必须实例关机才能调用本接口。
     */
    public ?bool $instanceCheckFlag = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'diskIds' => 'string',
    ];
}
