<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\Enum\DiscountMode;
use Monobank\Acquiring\Enum\DiscountType;
use Monobank\Acquiring\ValueObject\Discount;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class DiscountTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function test(DiscountType $type, DiscountMode $mode, int $value): void
    {
        $discount = new Discount($type, $mode, $value);

        self::assertEquals(
            [
                'type' => $type->value,
                'mode' => $mode->value,
                'value' => $value,
            ],
            $discount->toArray(),
        );
    }

    public static function dataProvider(): array
    {
        return [
            [
                DiscountType::DISCOUNT,
                DiscountMode::VALUE,
                500,
            ],
            [
                DiscountType::EXTRA_CHARGE,
                DiscountMode::VALUE,
                1500,
            ],
            [
                DiscountType::DISCOUNT,
                DiscountMode::PERCENT,
                100,
            ],
            [
                DiscountType::EXTRA_CHARGE,
                DiscountMode::PERCENT,
                0,
            ],
        ];
    }
}
