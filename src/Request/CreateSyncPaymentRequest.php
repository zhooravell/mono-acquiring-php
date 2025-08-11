<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request;

use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Request\Traits\SetMerchantPaymInfoTrait;
use Monobank\Acquiring\ValueObject\ApplePayData;
use Monobank\Acquiring\ValueObject\SyncPaymentCard;
use Monobank\Acquiring\ValueObject\GooglePayData;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--sync-payment
 */
class CreateSyncPaymentRequest extends AbstractRequest
{
    use SetMerchantPaymInfoTrait;

    public function __construct(int $amount, Currency $currency)
    {
        $this->setPayloadValue('amount', $amount);
        $this->setPayloadValue('ccy', $currency->value);
    }

    public function setCardData(SyncPaymentCard $card): self
    {
        $this->setPayloadValue('cardData', $card->toArray());

        return $this;
    }

    public function setApplePayData(ApplePayData $data): self
    {
        $this->setPayloadValue('applePay', $data->toArray());

        return $this;
    }

    public function setGooglePayData(GooglePayData $data): self
    {
        $this->setPayloadValue('googlePay', $data->toArray());

        return $this;
    }
}
