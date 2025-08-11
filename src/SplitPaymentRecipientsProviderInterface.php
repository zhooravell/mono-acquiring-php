<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Response\GetSplitPaymentRecipientListResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/get--api--merchant--split-receiver--list
 */
interface SplitPaymentRecipientsProviderInterface
{
    public function getSplitPaymentRecipientList(): GetSplitPaymentRecipientListResponse;
}
