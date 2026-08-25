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
 * CreateSubnetsRequest
 */
class CreateSubnetsRequest extends AbstractModel
{
    /**
     * VpcId 需要添加子网的VPC ID。
     * 批量创建的子网均属于同一个VPC。
     */
    public ?string $vpcId = null;

    /**
     * Subnets 待创建的子网列表。
     * 单次请求最多支持创建10个子网。
     * 该批次内的子网要么全部创建成功，要么全部不创建。
     *
     * @var list<SubnetCreateItem>|null
     */
    public ?array $subnets = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'subnets' => SubnetCreateItem::class,
    ];
}
