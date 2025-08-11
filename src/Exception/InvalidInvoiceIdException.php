<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

class InvalidInvoiceIdException extends Exception implements MonobankAcquiringException
{
    public static function blankValue(): self
    {
        return new self('Invoice Id should not be blank.', self::INVALID_INVOICE_ID_CODE);
    }
}
