<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Response\SubMerchantListResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/intehratory/marketpleisy-ta-ahenstka-skhema/get--api--merchant--submerchant--list
 */
interface SubMerchantListProviderInterface
{
    public function getSubMerchantList(): SubMerchantListResponse;
}
