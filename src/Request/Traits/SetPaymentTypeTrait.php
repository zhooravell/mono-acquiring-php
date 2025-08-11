<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request\Traits;

use Monobank\Acquiring\Enum\PaymentType;

/**
 * @method setPayloadValue(string $key, $value): void
 */
trait SetPaymentTypeTrait
{
    /**
     * paymentType
     *
     * Operation Type. If the value is hold, the term is 9 days.
     * If the hold isn't finalized within 9 days, it will be canceled.
     */
    public function setPaymentType(PaymentType $paymentType): self
    {
        $this->setPayloadValue('paymentType', $paymentType->value);

        return $this;
    }
}
