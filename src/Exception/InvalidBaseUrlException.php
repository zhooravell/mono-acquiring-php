<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

class InvalidBaseUrlException extends Exception implements MonobankAcquiringException
{
    public static function blankValue(): self
    {
        return new self('Base url should not be blank.', self::INVALID_BASE_URL_CODE);
    }

    public static function invalidURL(string $url): self
    {
        return new self(sprintf('Base url "%s" is not a valid url.', $url), self::INVALID_BASE_URL_CODE);
    }
}
