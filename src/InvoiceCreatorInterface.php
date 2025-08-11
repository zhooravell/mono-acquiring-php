<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\CreateInvoiceRequest;
use Monobank\Acquiring\Response\CreateInvoiceResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--create
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/post--api--merchant--invoice--create
 * @see https://monobank.ua/api-docs/acquiring/metody/oplata-v-zastosunku/post--api--merchant--invoice--create
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/post--api--merchant--invoice--create
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/tokenizatsiia/post--api--merchant--invoice--create
 * @see https://monobank.ua/api-docs/acquiring/intehratory/marketpleisy-ta-ahenstka-skhema/post--api--merchant--invoice--create
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--create
 */
interface InvoiceCreatorInterface
{
    /**
     * Creating an invoice for payment
     */
    public function createInvoice(CreateInvoiceRequest $request): CreateInvoiceResponse;
}
