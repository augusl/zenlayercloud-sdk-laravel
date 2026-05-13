<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Common\Exception;

use RuntimeException;
use Throwable;

class ZenlayerCloudSdkException extends RuntimeException
{
    public const ERR_JSON_PARSE = 'JSON_PARSE_FAILED';

    public const ERR_NETWORK = 'NETWORK_ERROR';

    public const ERR_CREDENTIAL_MISSING = 'CREDENTIAL_VALUE_MISSING';

    public const ERR_CONFIG_INVALID = 'CONFIG_INVALID';

    public function __construct(
        public readonly string $errorCode,
        string $message,
        public readonly ?string $requestId = null,
        ?Throwable $previous = null,
    ) {
        parent::__construct(
            $requestId === null
                ? "[ZenlayerCloudSdkError] Code={$errorCode}, Message={$message}"
                : "[ZenlayerCloudSdkError] Code={$errorCode}, Message={$message}, RequestId={$requestId}",
            0,
            $previous,
        );
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    public function getRequestId(): ?string
    {
        return $this->requestId;
    }
}
