<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

use DateTimeImmutable;
use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Enum\InvoiceStatus;
use Monobank\Acquiring\Enum\PaymentScheme;

class Statement
{
    public function __construct(
        private readonly ?string $invoiceId,
        private readonly InvoiceStatus $status,
        private readonly ?string $maskedPan,
        private readonly ?DateTimeImmutable $date,
        private readonly PaymentScheme $paymentScheme,
        private readonly ?int $amount,
        private readonly ?int $profitAmount,
        private readonly Currency $currency,
        private readonly ?string $approvalCode,
        private readonly ?string $rrn,
        private readonly ?string $reference,
        private readonly ?string $shortQrId,
        private readonly ?string $destination,
        private readonly array $cancelList,
    ) {
    }

    public function getInvoiceId(): ?string
    {
        return $this->invoiceId;
    }

    public function getStatus(): InvoiceStatus
    {
        return $this->status;
    }

    public function getMaskedPan(): ?string
    {
        return $this->maskedPan;
    }

    public function getDate(): ?DateTimeImmutable
    {
        return $this->date;
    }

    public function getPaymentScheme(): PaymentScheme
    {
        return $this->paymentScheme;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function getProfitAmount(): ?int
    {
        return $this->profitAmount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getApprovalCode(): ?string
    {
        return $this->approvalCode;
    }

    public function getRRN(): ?string
    {
        return $this->rrn;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function getShortQrId(): ?string
    {
        return $this->shortQrId;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    /**
     * @return CancelOperation[]
     */
    public function getCancelList(): array
    {
        return $this->cancelList;
    }
}
