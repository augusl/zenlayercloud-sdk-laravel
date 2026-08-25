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
 * AsnObservationDetail ASN 观测详情。
 */
class AsnObservationDetail extends AbstractModel
{
    /**
     * VerificationStatus ASN 验证状态。
     */
    public ?string $verificationStatus = null;

    /**
     * ObservedPrefix 观测网段。
     */
    public ?string $observedPrefix = null;

    /**
     * PrimarySource 主数据源名称，如 RIPE。
     */
    public ?string $primarySource = null;

    /**
     * PrimaryStatus 主数据源查询状态。
     */
    public ?string $primaryStatus = null;

    /**
     * PrimaryAsns 主数据源观测到的 ASN 列表。
     *
     * @var list<int>|null
     */
    public ?array $primaryAsns = null;

    /**
     * SecondarySource 该字段已下线，恒为 null。
     */
    public ?string $secondarySource = null;

    /**
     * SecondaryStatus 该字段已下线，恒为 null。
     */
    public ?string $secondaryStatus = null;

    /**
     * SecondaryAsns 该字段已下线，恒为 null。
     *
     * @var list<int>|null
     */
    public ?array $secondaryAsns = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'primaryAsns' => 'int',
        'secondaryAsns' => 'int',
    ];
}
