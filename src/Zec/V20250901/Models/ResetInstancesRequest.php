<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ResetInstancesRequest extends AbstractModel
{
    /**
     * InstanceIds 待重装的实例ID。
     */
    public ?array $instanceIds = null;

    /**
     * Password 实例的新密码。
     * 与keyId必须指定其中的一种（Windows和Generic类型的镜像无法指定密码和key）。
     * 必须包含以下3种格式的字符：大小写字母: [a-zA-Z]数字: 0-9特殊字符: ~!@$^*-_=+。
     */
    public ?string $password = null;

    /**
     * KeyId 密钥ID。
     * 与password必须指定其中的一种（Windows和Generic类型的镜像无法指定密码和key）。
     * 可调用接口DescribeKeyPairs来获得最新的密钥对信息。
     * 关联密钥后，就可以通过对应的私钥来访问实例；密钥与密码不能同时指定，同时Windows操作系统不支持指定密钥。
     * 示例值：key-YWD2QFOl。
     */
    public ?string $keyId = null;

    /**
     * ImageId 指定重装的的镜像ID。
     * 可以通过[DescribeImages](describeimages.md)取返回信息中的`imageId`字段。
     * 如果不指定，会根据当前镜像进行重装。
     */
    public ?string $imageId = null;

    /**
     * Timezone 操作系统时区设置。
     */
    public ?string $timezone = null;

    /**
     * EnableAgent 是否启用 QEMU Guest 代理 (QGA)。
     */
    public ?bool $enableAgent = null;

    /**
     * InstanceName 修改的实例名称。
     * 2～63个字符。
     * 仅支持输入字母、数字、-和英文句点(.)。
     */
    public ?string $instanceName = null;

    /**
     * UserData 初始化命令。
     */
    public ?string $userData = null;
}
