<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

class InvalidTerminalCodeException extends Exception implements MonobankAcquiringException
{
    public static function blankValue(): self
    {
        return new self('Terminal code should not be blank.', self::INVALID_TERMINAL_CODE);
    }
}
