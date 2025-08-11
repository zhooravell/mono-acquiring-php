<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

use Monobank\Acquiring\Enum\TokenizedCardStatus;

final class WalletData
{
    public function __construct(
        private readonly ?string $cardToken,
        private readonly ?string $walletId,
        private readonly TokenizedCardStatus $status = TokenizedCardStatus::UNKNOWN,
    ) {
    }

    public function getCardToken(): ?string
    {
        return $this->cardToken;
    }

    public function getWalletId(): ?string
    {
        return $this->walletId;
    }

    public function getStatus(): TokenizedCardStatus
    {
        return $this->status;
    }
}
