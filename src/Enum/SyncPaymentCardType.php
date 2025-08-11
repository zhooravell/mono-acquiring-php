<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Enum;

enum SyncPaymentCardType: string
{
    case UNKNOWN = 'unknown';
    case FPAN = 'FPAN';
    case DPAN = 'DPAN';
}
