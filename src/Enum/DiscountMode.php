<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Enum;

enum DiscountMode: string
{
    case UNKNOWN = 'unknown';
    case PERCENT = 'PERCENT';
    case VALUE = 'VALUE';
}
