<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

final class InvalidRedirectUrlException extends Exception implements MonobankAcquiringException
{
    public static function blankValue(): self
    {
        return new self('Redirect URL should not be blank.', self::INVALID_REDIRECT_URL_CODE);
    }

    public static function invalidURL(string $url): self
    {
        return new self(sprintf('Redirect URL "%s" is not a valid url.', $url), self::INVALID_REDIRECT_URL_CODE);
    }
}
