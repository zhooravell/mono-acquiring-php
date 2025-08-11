<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Enum;

enum FiscalReceiptType: string
{
    case UNKNOWN = 'unknown';
    case SALE = 'sale';
    case RETURN = 'return';
}
