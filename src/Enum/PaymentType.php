<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Enum;

enum PaymentType: string
{
    case Unknown = 'unknown';
    case Debit = 'debit';
    case Hold = 'hold';
}
