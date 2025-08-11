<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Response\GetQrTerminalListResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/get--api--merchant--qr--list
 */
interface QrTerminalListProviderInterface
{
    public function getQrTerminalList(): GetQrTerminalListResponse;
}
