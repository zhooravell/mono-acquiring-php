<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request;

use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Enum\InitiationKind;
use Monobank\Acquiring\Enum\PaymentType;
use Monobank\Acquiring\Request\Traits\SetMerchantPaymInfoTrait;
use Monobank\Acquiring\Request\Traits\SetPaymentTypeTrait;
use Monobank\Acquiring\Request\Traits\SetRedirectUrlTrait;
use Monobank\Acquiring\Request\Traits\SetSaveCardDataTrait;
use Monobank\Acquiring\Request\Traits\SetWebHookUrlTrait;
use Monobank\Acquiring\ValueObject\Card;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--payment-direct
 */
class CreatePaymentByCardCredentialsRequest extends AbstractRequest
{
    use SetRedirectUrlTrait;
    use SetWebHookUrlTrait;
    use SetSaveCardDataTrait;
    use SetPaymentTypeTrait;
    use SetMerchantPaymInfoTrait;

    public function __construct(int $amount, Currency $currency, Card $card, InitiationKind $initiationKind)
    {
        $this->setPayloadValue('amount', $amount);
        $this->setPayloadValue('ccy', $currency->value);
        $this->setPayloadValue('cardData', $card->toArray());
        $this->setPayloadValue('initiationKind', $initiationKind->value);
        $this->setPayloadValue('paymentType', PaymentType::Debit->value);
    }
}
