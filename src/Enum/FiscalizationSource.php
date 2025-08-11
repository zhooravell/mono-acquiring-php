<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Enum;

enum FiscalizationSource: string
{
    case UNKNOWN = 'unknown';
    case CHECKBOX = 'checkbox';
    case MONOPAY = 'monopay';
    case VCHASNOKASA = 'vchasnokasa';
}
