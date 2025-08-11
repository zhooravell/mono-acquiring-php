<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Enum;

enum MerchantInitiatedTransactionIndicator: string
{
    case MERCHANT = "1";
    case CUSTOMER = "2";
}
