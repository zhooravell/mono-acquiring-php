<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

use Monobank\Acquiring\Enum\Currency;
use DateTimeImmutable;

class CancelOperation
{
    public function __construct(
        private readonly ?int $amount,
        private readonly Currency $currency,
        private readonly ?DateTimeImmutable $date,
        private readonly ?string $approvalCode,
        private readonly ?string $rrn,
        private readonly ?string $maskedPan,
    ) {
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getDate(): ?DateTimeImmutable
    {
        return $this->date;
    }

    public function getApprovalCode(): ?string
    {
        return $this->approvalCode;
    }

    public function getRRN(): ?string
    {
        return $this->rrn;
    }

    public function getMaskedPan(): ?string
    {
        return $this->maskedPan;
    }
}
