<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\GetFiscalReceiptsRequest;
use Monobank\Acquiring\Request\GetReceiptRequest;
use Monobank\Acquiring\Response\GetFiscalReceiptsResponse;
use Monobank\Acquiring\Response\GetReceiptResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/get--api--merchant--invoice--receipt
 * @see https://monobank.ua/api-docs/acquiring/metody/oplata-v-zastosunku/get--api--merchant--invoice--receipt
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/get--api--merchant--invoice--receipt
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/prro/get--api--merchant--invoice--fiscal-checks
 */
interface ReceiptProviderInterface
{
    public function getReceipt(GetReceiptRequest $request): GetReceiptResponse;
    public function getFiscalReceipts(GetFiscalReceiptsRequest $request): GetFiscalReceiptsResponse;
}
