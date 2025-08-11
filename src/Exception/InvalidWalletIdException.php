<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

class InvalidWalletIdException extends Exception implements MonobankAcquiringException
{
    public static function blankValue(): self
    {
        return new self('Wallet ID should not be blank.', self::INVALID_WALLET_ID_CODE);
    }
}
