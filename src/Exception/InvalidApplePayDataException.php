<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

class InvalidApplePayDataException extends Exception implements MonobankAcquiringException
{
    public static function blankToken(): self
    {
        return new self('Apple Pay token should not be blank.', self::INVALID_APPLE_PAY_DATA_CODE);
    }

    public static function blankElectronicCommerceIndicator(): self
    {
        return new self('Apple Pay eciIndicator should not be blank.', self::INVALID_APPLE_PAY_DATA_CODE);
    }

    public static function invalidExpirationDate(): self
    {
        return new self(
            'Apple Pay expiration date should follow the "MMYY" format.',
            self::INVALID_APPLE_PAY_DATA_CODE,
        );
    }
}
