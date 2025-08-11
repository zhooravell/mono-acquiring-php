<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\CreateInvoiceRequest;
use Monobank\Acquiring\Request\FinalizeHoldRequest;
use Monobank\Acquiring\Request\GetInvoiceStatusRequest;
use Monobank\Acquiring\Request\InvalidateInvoiceRequest;
use Monobank\Acquiring\Response\CreateInvoiceResponse;
use Monobank\Acquiring\Response\FinalizeHoldResponse;
use Monobank\Acquiring\Response\GetInvoiceStatusResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/get--api--merchant--invoice--status
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/get--api--merchant--invoice--status
 * @see https://monobank.ua/api-docs/acquiring/metody/oplata-v-zastosunku/get--api--merchant--invoice--status
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/get--api--merchant--invoice--status
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/tokenizatsiia/get--api--merchant--invoice--status
 * @see https://monobank.ua/api-docs/acquiring/intehratory/marketpleisy-ta-ahenstka-skhema/get--api--merchant--invoice--status
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--finalize
 * @see https://monobank.ua/api-docs/acquiring/metody/oplata-v-zastosunku/post--api--merchant--invoice--finalize
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--create
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/post--api--merchant--invoice--create
 * @see https://monobank.ua/api-docs/acquiring/metody/oplata-v-zastosunku/post--api--merchant--invoice--create
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/post--api--merchant--invoice--create
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/tokenizatsiia/post--api--merchant--invoice--create
 * @see https://monobank.ua/api-docs/acquiring/intehratory/marketpleisy-ta-ahenstka-skhema/post--api--merchant--invoice--create
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--create
 * @see https://monobank.ua/api-docs/acquiring/intehratory/marketpleisy-ta-ahenstka-skhema/post--api--merchant--invoice--remove
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--remove
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/post--api--merchant--invoice--remove
 * @see https://monobank.ua/api-docs/acquiring/metody/oplata-v-zastosunku/post--api--merchant--invoice--remove
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/post--api--merchant--invoice--remove
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/tokenizatsiia/post--api--merchant--invoice--remove
 */
interface InvoiceManagementInterface
{
    public function createInvoice(CreateInvoiceRequest $request): CreateInvoiceResponse;
    public function getInvoiceStatus(GetInvoiceStatusRequest $request): GetInvoiceStatusResponse;
    public function finalizeHold(FinalizeHoldRequest $request): FinalizeHoldResponse;
    public function invalidateInvoice(InvalidateInvoiceRequest $request): void;
}
