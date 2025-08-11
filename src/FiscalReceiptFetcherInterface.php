<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\GetFiscalReceiptsRequest;
use Monobank\Acquiring\Response\GetFiscalReceiptsResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/prro/get--api--merchant--invoice--fiscal-checks
 */
interface FiscalReceiptFetcherInterface
{
    public function getFiscalReceipts(GetFiscalReceiptsRequest $request): GetFiscalReceiptsResponse;
}
