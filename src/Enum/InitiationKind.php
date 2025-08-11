<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Enum;

enum InitiationKind: string
{
    case UNKNOWN = 'unknown';
    case CLIENT = 'client';
    case MERCHANT = 'merchant';
}
