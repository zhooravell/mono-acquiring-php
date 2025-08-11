<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

use Monobank\Acquiring\Response\Traits\GetAmountTrait;
use Monobank\Acquiring\Response\Traits\GetCancelListTrait;
use Monobank\Acquiring\Response\Traits\GetCreatedDateTrait;
use Monobank\Acquiring\Response\Traits\GetCurrencyTrait;
use Monobank\Acquiring\Response\Traits\GetDestinationTrait;
use Monobank\Acquiring\Response\Traits\GetErrorCodeTrait;
use Monobank\Acquiring\Response\Traits\GetFailureReasonTrait;
use Monobank\Acquiring\Response\Traits\GetFinalAmountTrait;
use Monobank\Acquiring\Response\Traits\GetInvoiceIdTrait;
use Monobank\Acquiring\Response\Traits\GetModifiedDateTrait;
use Monobank\Acquiring\Response\Traits\GetPaymentInfoTrait;
use Monobank\Acquiring\Response\Traits\GetReferenceTrait;
use Monobank\Acquiring\Response\Traits\GetStatusInvoiceStatusTrait;
use Monobank\Acquiring\Response\Traits\GetTipsInfoTrait;
use Monobank\Acquiring\Response\Traits\GetWalletDataTrait;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--sync-payment
 */
class CreateSyncPaymentResponse extends AbstractResponse
{
    use GetInvoiceIdTrait;
    use GetStatusInvoiceStatusTrait;
    use GetFailureReasonTrait;
    use GetErrorCodeTrait;
    use GetAmountTrait;
    use GetCurrencyTrait;
    use GetFinalAmountTrait;
    use GetCreatedDateTrait;
    use GetModifiedDateTrait;
    use GetReferenceTrait;
    use GetDestinationTrait;
    use GetCancelListTrait;
    use GetPaymentInfoTrait;
    use GetWalletDataTrait;
    use GetTipsInfoTrait;
}
