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
 * UnassociateVpcCidrBlockRequest
 */
class UnassociateVpcCidrBlockRequest extends AbstractModel
{
    /**
     * VpcId VPC的ID。
     * 默认VPC不支持移除附属网段。
     * 可通过调用 ~~DescribeVpcs~~ 获取。
     */
    public ?string $vpcId = null;

    /**
     * CidrBlock 要移除的附属IPv4 CIDR。
     * 必须与该VPC上已有的某个附属网段完全一致。
     * 只能移除附属网段：传入主网段会被拒绝，主网段不支持删除，只能通过 ~~ModifyVpcAttribute~~ 在原网段内放大或缩小。
     * 该附属网段下不能存在子网，否则请求会被拒绝；请先删除该网段下的所有子网。
     * 附属网段不支持修改，如需调整大小，请先移除再重新调用 ~~AssociateVpcCidrBlock~~ 添加。
     */
    public ?string $cidrBlock = null;
}
