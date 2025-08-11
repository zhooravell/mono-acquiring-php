<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

final class InvalidAPITokenException extends Exception implements MonobankAcquiringException
{
    public static function blankValue(): self
    {
        return new self('API Token should not be blank.', self::INVALID_API_TOKEN_CODE);
    }
}
