<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject\Traits;

trait ValidExpiryDateTrait
{
    public static function isValidExpiryDate(string $expiryDate): bool
    {
        $expiryDate = preg_replace('/[^0-9]/', '', $expiryDate);

        if (strlen($expiryDate) !== 4) {
            return false;
        }

        $month = (int)substr($expiryDate, 0, 2);

        if ($month < 1 || $month > 12) {
            return false;
        }

        return true;
    }
}
