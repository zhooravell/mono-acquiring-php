<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

/**
 * @see https://api.monobank.ua/docs/acquiring.html
 */
final class SubMerchant
{
    public function __construct(
        private readonly ?string $code,
        private readonly ?string $edrpou,
        private readonly ?string $iban,
        private readonly ?string $owner,
    ) {
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getEdrpou(): ?string
    {
        return $this->edrpou;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }
}
