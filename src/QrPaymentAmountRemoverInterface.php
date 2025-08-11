<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\RemoveQrPaymentAmountRequest;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/post--api--merchant--qr--reset-amount
 */
interface QrPaymentAmountRemoverInterface
{
    public function removeQrPaymentAmount(RemoveQrPaymentAmountRequest $request): void;
}
