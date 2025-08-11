<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

class WebhookSignatureException extends Exception implements MonobankAcquiringException
{
    public static function create(string $opensslError): self
    {
        return new self('Error verifying signature: ' . $opensslError, self::WEBHOOK_VERIFICATION_ERROR_CODE);
    }
}
