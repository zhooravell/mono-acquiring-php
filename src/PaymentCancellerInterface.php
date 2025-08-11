<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\CancelPaymentRequest;
use Monobank\Acquiring\Response\CancelPaymentResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--cancel
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/post--api--merchant--invoice--cancel
 * @see https://monobank.ua/api-docs/acquiring/metody/oplata-v-zastosunku/post--api--merchant--invoice--cancel
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/post--api--merchant--invoice--cancel
 */
interface PaymentCancellerInterface
{
    /**
     * Canceling a successful invoice payment
     */
    public function cancelPayment(CancelPaymentRequest $request): CancelPaymentResponse;
}
