<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

class InvalidGooglePayDataException extends Exception implements MonobankAcquiringException
{
    public static function blankToken(): self
    {
        return new self('Google Pay token should not be blank.', self::INVALID_GOOGLE_PAY_DATA_CODE);
    }

    public static function blankElectronicCommerceIndicator(): self
    {
        return new self('Google Pay eciIndicator should not be blank.', self::INVALID_GOOGLE_PAY_DATA_CODE);
    }

    public static function invalidExpirationDate(): self
    {
        return new self(
            'Google Pay expiration date should follow the "MMYY" format.',
            self::INVALID_GOOGLE_PAY_DATA_CODE,
        );
    }
}
