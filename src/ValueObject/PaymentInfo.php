<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

use Monobank\Acquiring\Enum\Country;
use Monobank\Acquiring\Enum\PaymentMethod;
use Monobank\Acquiring\Enum\PaymentSystem;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/get--api--merchant--invoice--status
 */
final class PaymentInfo
{
    public function __construct(
        private readonly ?string $maskedPan,
        private readonly ?string $approvalCode,
        private readonly ?string $rrn,
        private readonly ?string $transactionId,
        private readonly ?string $terminal,
        private readonly ?string $bank,
        private readonly PaymentSystem $paymentSystem,
        private readonly PaymentMethod $paymentMethod,
        private readonly ?int $fee,
        private readonly Country $country,
        private readonly ?int $agentFee,
    ) {
    }

    public function getMaskedPan(): ?string
    {
        return $this->maskedPan;
    }

    public function getApprovalCode(): ?string
    {
        return $this->approvalCode;
    }

    public function getRrn(): ?string
    {
        return $this->rrn;
    }

    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    public function getTerminal(): ?string
    {
        return $this->terminal;
    }

    public function getBank(): ?string
    {
        return $this->bank;
    }

    public function getPaymentSystem(): PaymentSystem
    {
        return $this->paymentSystem;
    }

    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function getFee(): ?int
    {
        return $this->fee;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function getAgentFee(): ?int
    {
        return $this->agentFee;
    }
}
