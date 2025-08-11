<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Enum;

enum QrTerminalAmountType: string
{
    case UNKNOWN = 'unknown';
    case MERCHANT = 'merchant';
    case CLIENT = 'client';
    case FIX = 'fix';
}
