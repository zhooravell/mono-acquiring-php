<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Enum;

enum PaymentMethod: string
{
    case UNKNOWN = 'unknown';
    case PAN = 'pan';
    case APPLE = 'apple';
    case GOOGLE = 'google';
    case MONOBANK = 'monobank';
    case WALLET = 'wallet';
    case DIRECT = 'direct';
}
