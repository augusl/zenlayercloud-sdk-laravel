<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Common;

/**
 * Optional STS extension matching the official Go SecurityTokenCredential.
 * Existing CredentialInterface implementations need no additional method.
 */
interface SecurityTokenCredentialInterface extends CredentialInterface
{
    public function getSecurityToken(): string;
}
