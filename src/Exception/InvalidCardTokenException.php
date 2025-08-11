<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

class InvalidCardTokenException extends Exception implements MonobankAcquiringException
{
    public static function blankValue(): self
    {
        return new self('Card token should not be blank.', self::INVALID_CARD_TOKEN_CODE);
    }
}
