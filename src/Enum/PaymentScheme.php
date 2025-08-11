<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Enum;

enum PaymentScheme: string
{
    case UNKNOWN = 'unknown';
    case FULL = 'full';
    case BNPL_PARTS_4 = 'bnpl_parts_4';
    case BNPL_LATER_30 = 'bnpl_later_30';
}
