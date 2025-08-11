<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

use Monobank\Acquiring\Enum\FiscalizationSource;
use Monobank\Acquiring\Enum\FiscalReceiptStatus;
use Monobank\Acquiring\Enum\FiscalReceiptType;

final class FiscalReceipt
{
    public function __construct(
        private readonly ?string $id,
        private readonly FiscalReceiptType $type,
        private readonly FiscalReceiptStatus $status,
        private readonly ?string $statusDescription,
        private readonly ?string $taxUrl,
        private readonly ?string $file,
        private readonly FiscalizationSource $fiscalizationSource,
    ) {
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getType(): FiscalReceiptType
    {
        return $this->type;
    }

    public function getStatus(): FiscalReceiptStatus
    {
        return $this->status;
    }

    public function getStatusDescription(): ?string
    {
        return $this->statusDescription;
    }

    public function getTaxUrl(): ?string
    {
        return $this->taxUrl;
    }

    /**
     * Base64-encoded PDF receipt file
     */
    public function getFile(): ?string
    {
        return $this->file;
    }

    public function getFiscalizationSource(): FiscalizationSource
    {
        return $this->fiscalizationSource;
    }
}
