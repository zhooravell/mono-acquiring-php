<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

use DateTimeImmutable;
use Monobank\Acquiring\Enum\CancellationStatus;
use Monobank\Acquiring\Enum\Currency;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/get--api--merchant--invoice--status
 */
final class CancelListItem
{
    public function __construct(
        private readonly CancellationStatus $status,
        private readonly ?int $amount,
        private readonly Currency $currency,
        private readonly ?DateTimeImmutable $createdDate,
        private readonly ?DateTimeImmutable $modifiedDate,
        private readonly ?string $approvalCode,
        private readonly ?string $rrn,
        private readonly ?string $extRef,
    ) {
    }

    public function getStatus(): CancellationStatus
    {
        return $this->status;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getCreatedDate(): ?DateTimeImmutable
    {
        return $this->createdDate;
    }

    public function getModifiedDate(): ?DateTimeImmutable
    {
        return $this->modifiedDate;
    }

    public function getApprovalCode(): ?string
    {
        return $this->approvalCode;
    }

    public function getRrn(): ?string
    {
        return $this->rrn;
    }

    public function getExternalReference(): ?string
    {
        return $this->extRef;
    }
}
