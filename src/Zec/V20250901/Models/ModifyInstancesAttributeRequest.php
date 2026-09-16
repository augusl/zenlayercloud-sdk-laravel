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
 * ModifyInstancesAttributeRequest
 */
class ModifyInstancesAttributeRequest extends AbstractModel
{
    /**
     * InstanceIds 待修改属性的实例ID列表。
     *
     * @var list<string>|null
     */
    public ?array $instanceIds = null;

    /**
     * InstanceName 实例名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、英文句点(.)、下划线(_)、斜杠(/)和连字符(-)，且必须以字母或数字开头和结尾。
     * 批量修改多台实例时，可以指定模式串[begin_number,bits]，按instanceIds列表的顺序依次编号。
     * begin_number：有序数值的起始值，取值支持[0,99999]。
     * bits：有序数值所占的位数，取值支持[1,6]，位数不足时前面补0，数值超出该位数时不截断。
     * 注意模式串中不得有空格。
     * 例如修改2台实例时，指定server-[3,3]，实例名称分别为server-003、server-004。
     * 支持指定多个模式串，如server-[3,3]-[1,1]。
     * 不指定模式串时，所有实例修改为同一名称。
     */
    public ?string $instanceName = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'instanceIds' => 'string',
    ];
}
