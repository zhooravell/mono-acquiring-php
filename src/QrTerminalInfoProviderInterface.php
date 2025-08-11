<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\GetQrTerminalInfoRequest;
use Monobank\Acquiring\Response\GetQrTerminalInfoResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/get--api--merchant--qr--details
 */
interface QrTerminalInfoProviderInterface
{
    public function getQrTerminalInfo(GetQrTerminalInfoRequest $request): GetQrTerminalInfoResponse;
}
