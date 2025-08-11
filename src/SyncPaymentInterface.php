<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\CreateSyncPaymentRequest;
use Monobank\Acquiring\Response\CreateSyncPaymentResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--sync-payment
 */
interface SyncPaymentInterface
{
    public function createSyncPayment(CreateSyncPaymentRequest $request): CreateSyncPaymentResponse;
}
