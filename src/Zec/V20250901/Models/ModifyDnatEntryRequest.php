<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyDnatEntryRequest extends AbstractModel
{
    /**
     * DnatEntryId DNAT规则 ID。
     */
    public ?string $dnatEntryId = null;

    /**
     * EipId 修改DNAT关联的弹性公网IP ID。
     */
    public ?string $eipId = null;

    /**
     * PrivateIp DNAT规则的内网IP地址。
     */
    public ?string $privateIp = null;

    /**
     * Protocol DNAT规则的协议类型。
     */
    public ?string $protocol = null;

    /**
     * ListenerPort DNAT规则端口转发的外部端口或端口段，取值范围1-65535。
     */
    public ?string $listenerPort = null;

    /**
     * InternalPort DNAT规则端口转发的内部端口或端口段，取值范围1-65535。
     */
    public ?string $internalPort = null;
}
