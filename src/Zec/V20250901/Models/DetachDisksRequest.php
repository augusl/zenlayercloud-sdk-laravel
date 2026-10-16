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
     * 可通过调用 ~~DescribeDisks~~ 获取。
     *
     * @var list<string>|null
     */
    public ?array $diskIds = null;

    /**
     * InstanceCheckFlag 是否检测实例的运行状态。
     * 开启时，云硬盘所挂载的实例必须已关机才允许卸载；关闭时，不检测实例状态。
     */
    public ?bool $instanceCheckFlag = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'diskIds' => 'string',
    ];
}
