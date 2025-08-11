<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

use Monobank\Acquiring\Enum\DiscountMode;
use Monobank\Acquiring\Enum\DiscountType;

/**
 * @see https://api.monobank.ua/docs/acquiring.html
 */
final class Discount
{
    public function __construct(
        private readonly DiscountType $discountType,
        private readonly DiscountMode $discountMode,
        private readonly float $value,
    ) {
    }

    public function toArray(): array
    {
        return [
            'type' => $this->discountType->value,
            'mode' => $this->discountMode->value,
            'value' => $this->value,
        ];
    }
}
