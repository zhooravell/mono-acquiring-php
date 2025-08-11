<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

class TipsInfo
{
    public function __construct(
        private readonly ?string $employeeId,
        private readonly ?int $amount = null,
    ) {
    }

    public function getEmployeeId(): ?string
    {
        return $this->employeeId;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }
}
