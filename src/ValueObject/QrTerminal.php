<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

use Monobank\Acquiring\Enum\QrTerminalAmountType;

/**
 * @see https://api.monobank.ua/docs/acquiring.html
 */
final class QrTerminal
{
    public function __construct(
        private readonly string $shortQrId,
        private readonly string $qrId,
        private readonly QrTerminalAmountType $amountType,
        private readonly string $pageUrl,
    ) {
    }

    public function getShortQrId(): string
    {
        return $this->shortQrId;
    }

    public function getQrId(): string
    {
        return $this->qrId;
    }

    public function getAmountType(): QrTerminalAmountType
    {
        return $this->amountType;
    }

    public function getPageUrl(): string
    {
        return $this->pageUrl;
    }
}
