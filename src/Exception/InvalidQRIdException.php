<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

class InvalidQRIdException extends Exception implements MonobankAcquiringException
{
    public static function blankValue(): self
    {
        return new self('QR Id should not be blank.', self::INVALID_QR_ID_CODE);
    }
}
