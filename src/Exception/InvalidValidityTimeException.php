<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

final class InvalidValidityTimeException extends Exception implements MonobankAcquiringException
{
    public static function negativeOrZero(): self
    {
        return new self('Validity time should be greater than zero.', self::INVALID_VALIDITY_TIME_CODE);
    }
}
