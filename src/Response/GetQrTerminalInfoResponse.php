<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

use Monobank\Acquiring\Response\Traits\GetAmountTrait;
use Monobank\Acquiring\Response\Traits\GetCurrencyTrait;
use Monobank\Acquiring\Response\Traits\GetInvoiceIdTrait;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/get--api--merchant--qr--details
 */
class GetQrTerminalInfoResponse extends AbstractResponse
{
    use GetAmountTrait;
    use GetInvoiceIdTrait;
    use GetCurrencyTrait;

    public function getShortQrId(): ?string
    {
        return $this->getString('shortQrId');
    }
}
