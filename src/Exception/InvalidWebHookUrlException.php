<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

final class InvalidWebHookUrlException extends Exception implements MonobankAcquiringException
{
    public static function blankValue(): self
    {
        return new self('Webhook should not be blank.', self::INVALID_WEBHOOK_URL_CODE);
    }

    public static function invalidURL(string $url): self
    {
        return new self(sprintf('Webhook "%s" is not a valid url.', $url), self::INVALID_WEBHOOK_URL_CODE);
    }
}
