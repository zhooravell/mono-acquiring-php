<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\InvalidateInvoiceRequest;

/**
 * @see https://monobank.ua/api-docs/acquiring/intehratory/marketpleisy-ta-ahenstka-skhema/post--api--merchant--invoice--remove
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--remove
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/post--api--merchant--invoice--remove
 * @see https://monobank.ua/api-docs/acquiring/metody/oplata-v-zastosunku/post--api--merchant--invoice--remove
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/post--api--merchant--invoice--remove
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/tokenizatsiia/post--api--merchant--invoice--remove
 */
interface InvoiceInvalidatorInterface
{
    /**
     * Invalidation of an invoice if payment has not yet been made.
     */
    public function invalidateInvoice(InvalidateInvoiceRequest $request): void;
}
