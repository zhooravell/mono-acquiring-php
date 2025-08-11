<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Enum;

enum DiscountType: string
{
    case DISCOUNT = 'DISCOUNT';
    case EXTRA_CHARGE = 'EXTRA_CHARGE';
}
