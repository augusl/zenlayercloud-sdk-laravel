<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateInstancesResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * OrderNumber 订单编号。
     */
    public ?string $orderNumber = null;

    /**
     * InstanceIdSet 虚拟机实例ID列表。
     * 当通过本接口来创建实例时会返回该参数，表示一个或多个实例ID。
     * 返回实例ID列表并不代表实例创建成功，可根据 DescribeInstances 接口查询返回的dataSet中对应实例的状态来判断创建是否完成：如果实例状态由DEPLOYING(部署中)或PENDING（待创建）变为RUNNING(运行中)，则为创建成功；如果实例找不到或状态变为CREATE_FAILED，表示创建失败。
     *
     * @var list<string>|null
     */
    public ?array $instanceIdSet = null;

    /**
     * Instances 随机器创建的数据盘ID集合。
     * 如果请求中没有指定数据盘，返回空数组。
     *
     * @var list<DiskWithInstance>|null
     */
    public ?array $instances = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'instances' => DiskWithInstance::class,
    ];

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'instanceIdSet' => 'string',
    ];
}
