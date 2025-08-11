<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Enum;

enum InvoiceStatus: string
{
    case UNKNOWN = 'unknown';
    case CREATED = 'created';
    case PROCESSING = 'processing';
    case HOLD = 'hold';
    case SUCCESS = 'success';
    case FAILURE = 'failure';
    case REVERSED = 'reversed';
    case EXPIRED = 'expired';
}
