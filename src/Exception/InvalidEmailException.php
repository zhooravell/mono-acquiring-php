<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

class InvalidEmailException extends Exception implements MonobankAcquiringException
{
    public static function invalidEmail(string $value): self
    {
        return new self(
            sprintf('The email %s is not a valid email.', $value),
            self::INVALID_EMAIL_CODE,
        );
    }
}
