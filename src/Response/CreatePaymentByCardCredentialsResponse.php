<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

use Monobank\Acquiring\Response\Traits\GetAmountTrait;
use Monobank\Acquiring\Response\Traits\GetCreatedDateTrait;
use Monobank\Acquiring\Response\Traits\GetCurrencyTrait;
use Monobank\Acquiring\Response\Traits\GetFailureReasonTrait;
use Monobank\Acquiring\Response\Traits\GetInvoiceIdTrait;
use Monobank\Acquiring\Response\Traits\GetModifiedDateTrait;
use Monobank\Acquiring\Response\Traits\GetStatusInvoiceStatusTrait;
use Monobank\Acquiring\Response\Traits\GetTdsUrlTrait;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--payment-direct
 */
class CreatePaymentByCardCredentialsResponse extends AbstractResponse
{
    use GetInvoiceIdTrait;
    use GetFailureReasonTrait;
    use GetAmountTrait;
    use GetCurrencyTrait;
    use GetCreatedDateTrait;
    use GetModifiedDateTrait;
    use GetTdsUrlTrait;
    use GetStatusInvoiceStatusTrait;
}
