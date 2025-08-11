<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\GetQrTerminalInfoRequest;
use Monobank\Acquiring\Request\RemoveQrPaymentAmountRequest;
use Monobank\Acquiring\Response\GetQrTerminalInfoResponse;
use Monobank\Acquiring\Response\GetQrTerminalListResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/get--api--merchant--qr--list
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/post--api--merchant--qr--reset-amount
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/get--api--merchant--qr--details
 */
interface QRTerminalManagementInterface
{
    public function getQrTerminalList(): GetQrTerminalListResponse;
    public function getQrTerminalInfo(GetQrTerminalInfoRequest $request): GetQrTerminalInfoResponse;
    public function removeQrPaymentAmount(RemoveQrPaymentAmountRequest $request): void;
}
