<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response\Traits;

use Monobank\Acquiring\Enum\Currency;

/**
 * @method getCurrencyEnum(string $key): Currency
 */
trait GetCurrencyTrait
{
    public function getCurrency(): Currency
    {
        return $this->getCurrencyEnum('ccy');
    }
}
