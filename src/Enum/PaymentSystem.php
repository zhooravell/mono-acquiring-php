<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Enum;

enum PaymentSystem: string
{
    case UNKNOWN = 'unknown';
    case VISA = 'visa';
    case MASTERCARD = 'mastercard';
}
