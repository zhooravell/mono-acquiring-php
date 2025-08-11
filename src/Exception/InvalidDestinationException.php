<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

class InvalidDestinationException extends Exception implements MonobankAcquiringException
{
    public static function maxLength(int $length): self
    {
        return new self(
            sprintf('Destination cannot be longer than %d characters.', $length),
            self::INVALID_DESTINATION_CODE,
        );
    }
}
