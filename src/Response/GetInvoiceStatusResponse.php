<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

use DateTimeImmutable;
use Monobank\Acquiring\Enum\CancellationStatus;
use Monobank\Acquiring\Enum\Country;
use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Enum\InvoiceStatus;
use Monobank\Acquiring\Enum\PaymentMethod;
use Monobank\Acquiring\Enum\PaymentSystem;
use Monobank\Acquiring\Enum\TokenizedCardStatus;
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
use Monobank\Acquiring\ValueObject\CancelListItem;
use Monobank\Acquiring\ValueObject\PaymentInfo;
use Monobank\Acquiring\ValueObject\TipsInfo;
use Monobank\Acquiring\ValueObject\WalletData;
use Throwable;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/get--api--merchant--invoice--status
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/get--api--merchant--invoice--status
 * @see https://monobank.ua/api-docs/acquiring/metody/oplata-v-zastosunku/get--api--merchant--invoice--status
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/get--api--merchant--invoice--status
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/tokenizatsiia/get--api--merchant--invoice--status
 * @see https://monobank.ua/api-docs/acquiring/intehratory/marketpleisy-ta-ahenstka-skhema/get--api--merchant--invoice--status
 */
class GetInvoiceStatusResponse extends AbstractResponse
{
    use GetInvoiceIdTrait;
    use GetAmountTrait;
    use GetCreatedDateTrait;
    use GetModifiedDateTrait;
    use GetCurrencyTrait;
    use GetFailureReasonTrait;
    use GetStatusInvoiceStatusTrait;
    use GetErrorCodeTrait;
    use GetFinalAmountTrait;
    use GetReferenceTrait;
    use GetDestinationTrait;
    use GetCancelListTrait;
    use GetPaymentInfoTrait;
    use GetWalletDataTrait;
    use GetTipsInfoTrait;
}
