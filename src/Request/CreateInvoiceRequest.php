<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request;

use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Enum\PaymentType;
use Monobank\Acquiring\Exception\InvalidQRIdException;
use Monobank\Acquiring\Exception\InvalidValidityTimeException;
use Monobank\Acquiring\Exception\InvalidTerminalCodeException;
use Monobank\Acquiring\Exception\InvalidEmployeeIdException;
use Monobank\Acquiring\Request\Traits\SetMerchantPaymInfoTrait;
use Monobank\Acquiring\Request\Traits\SetPaymentTypeTrait;
use Monobank\Acquiring\Request\Traits\SetRedirectUrlTrait;
use Monobank\Acquiring\Request\Traits\SetSaveCardDataTrait;
use Monobank\Acquiring\Request\Traits\SetWebHookUrlTrait;
use Monobank\Acquiring\ValueObject\BasketItem;
use Monobank\Acquiring\ValueObject\Discount;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--create
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/post--api--merchant--invoice--create
 * @see https://monobank.ua/api-docs/acquiring/metody/oplata-v-zastosunku/post--api--merchant--invoice--create
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/post--api--merchant--invoice--create
 */
final class CreateInvoiceRequest extends AbstractRequest
{
    use SetRedirectUrlTrait;
    use SetWebHookUrlTrait;
    use SetPaymentTypeTrait;
    use SetMerchantPaymInfoTrait;
    use SetSaveCardDataTrait;

    public function __construct(int $amount, PaymentType $paymentType = PaymentType::Debit)
    {
        $this->setPayloadValue('amount', $amount);
        $this->setPayloadValue('paymentType', $paymentType->value);
    }

    /**
     * ccy
     *
     * ISO 4217 currency code, default 980 (hryvnia).
     */
    public function setCurrency(Currency $currency): self
    {
        $this->setPayloadValue('ccy', $currency->value);

        return $this;
    }

    /**
     * validity
     *
     * Expiration time in seconds; by default, the invoice becomes invalid after 24 hours.
     *
     * @throws InvalidValidityTimeException
     */
    public function setValidity(int $seconds): self
    {
        if ($seconds <= 0) {
            throw InvalidValidityTimeException::negativeOrZero();
        }

        $this->setPayloadValue('validity', $seconds);

        return $this;
    }

    /**
     * @throws InvalidQRIdException
     */
    public function setQRId(string $qrId): self
    {
        $qrId = trim(strip_tags($qrId));

        if (empty($qrId)) {
            throw InvalidQRIdException::blankValue();
        }

        $this->setPayloadValue('qrId', $qrId);

        return $this;
    }

    /**
     * Sub-merchant Terminal Code
     * From the "List Sub-merchants" API. This is available to a limited group of merchants who specifically require it.
     *
     * @throws InvalidTerminalCodeException
     */
    public function setTerminalCode(string $code): self
    {
        $code = trim(strip_tags($code));

        if (empty($code)) {
            throw InvalidTerminalCodeException::blankValue();
        }

        $this->setPayloadValue('code', $code);

        return $this;
    }

    /**
     * Employee ID for Tips
     * This is the identifier of the employee eligible to receive tips after payment.
     * You can obtain this ID from the "List Employees" API.
     *
     * @throws InvalidEmployeeIdException
     */
    public function setTipsEmployeeId(string $employeeId): self
    {
        $employeeId = trim(strip_tags($employeeId));

        if (empty($employeeId)) {
            throw InvalidEmployeeIdException::blankValue();
        }

        $this->setPayloadValue('tipsEmployeeId', $employeeId);

        return $this;
    }

    /**
     * agentFeePercent
     *
     * Agent's Self-Set Commission Percentage
     */
    public function setAgentFeePercent(float $percent): self
    {
        $this->setPayloadValue('agentFeePercent', $percent);

        return $this;
    }
}
