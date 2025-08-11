<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response\Traits;

use Monobank\Acquiring\Enum\Country;
use Monobank\Acquiring\Enum\PaymentMethod;
use Monobank\Acquiring\Enum\PaymentSystem;
use Monobank\Acquiring\ValueObject\PaymentInfo;

trait GetPaymentInfoTrait
{
    public function getPaymentInfo(): PaymentInfo
    {
        $value = $this->getArray('paymentInfo');

        $paymentSystem = array_key_exists('paymentSystem', $value)
            ? PaymentSystem::tryFrom((string)$value['paymentSystem']) ?: PaymentSystem::UNKNOWN
            : PaymentSystem::UNKNOWN;

        $paymentMethod = array_key_exists('paymentMethod', $value)
            ? PaymentMethod::tryFrom((string)$value['paymentMethod']) ?: PaymentMethod::UNKNOWN
            : PaymentMethod::UNKNOWN;

        $country = array_key_exists('country', $value)
            ? Country::tryFrom((int)$value['country']) ?: Country::UNKNOWN
            : Country::UNKNOWN;

        return new PaymentInfo(
            self::stringOrNull($value, 'maskedPan'),
            self::stringOrNull($value, 'approvalCode'),
            self::stringOrNull($value, 'rrn'),
            self::stringOrNull($value, 'tranId'),
            self::stringOrNull($value, 'terminal'),
            self::stringOrNull($value, 'bank'),
            $paymentSystem,
            $paymentMethod,
            self::intOrNull($value, 'fee'),
            $country,
            self::intOrNull($value, 'agentFee'),
        );
    }
}
