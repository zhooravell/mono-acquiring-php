<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request;

use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Enum\InitiationKind;
use Monobank\Acquiring\Exception\InvalidCardTokenException;
use Monobank\Acquiring\Request\Traits\SetMerchantPaymInfoTrait;
use Monobank\Acquiring\Request\Traits\SetPaymentTypeTrait;
use Monobank\Acquiring\Request\Traits\SetRedirectUrlTrait;
use Monobank\Acquiring\Request\Traits\SetWebHookUrlTrait;

/**
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/tokenizatsiia/post--api--merchant--wallet--payment
 */
final class CreateTokenPaymentRequest extends AbstractRequest
{
    use SetRedirectUrlTrait;
    use SetWebHookUrlTrait;
    use SetPaymentTypeTrait;
    use SetMerchantPaymInfoTrait;

    /**
     * @throws InvalidCardTokenException
     */
    public function __construct(string $cardToken, int $amount, Currency $currency, InitiationKind $initiationKind)
    {
        $cardToken = trim(strip_tags($cardToken));

        if (empty($cardToken)) {
            throw InvalidCardTokenException::blankValue();
        }

        $this->setPayloadValue('cardToken', $cardToken);
        $this->setPayloadValue('amount', $amount);
        $this->setPayloadValue('ccy', $currency->value);
        $this->setPayloadValue('initiationKind', $initiationKind->value);
    }
}
