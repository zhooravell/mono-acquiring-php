<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

use Monobank\Acquiring\Enum\Country;

final class TokenizedCard
{
    public function __construct(
        private readonly string $cardToken,
        private readonly string $maskedPan,
        private readonly Country $country = Country::UNKNOWN,
    ) {
    }

    public function getCardToken(): string
    {
        return $this->cardToken;
    }

    public function getMaskedPan(): string
    {
        return $this->maskedPan;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }
}
