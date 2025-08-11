<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

class InvalidCardException extends Exception implements MonobankAcquiringException
{
    public static function blankCardNumber(): self
    {
        return new self('Card number should not be blank.', self::INVALID_CARD_DATA_CODE);
    }

    public static function blankExpirationDate(): self
    {
        return new self('Card expiration date should not be blank.', self::INVALID_CARD_DATA_CODE);
    }

    public static function invalidExpirationDate(): self
    {
        return new self('Card expiration date should follow the "MMYY" format.', self::INVALID_CARD_DATA_CODE);
    }

    public static function blankCVV(): self
    {
        return new self('Card cvv should not be blank.', self::INVALID_CARD_DATA_CODE);
    }

    public static function invalidCVV(): self
    {
        return new self('Invalid card cvv.', self::INVALID_CARD_DATA_CODE);
    }

    public static function invalidElectronicCommerceIndicator(): self
    {
        return new self('eciIndicator should not be blank.', self::INVALID_CARD_DATA_CODE);
    }
}
