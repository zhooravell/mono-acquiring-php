<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\Enum\DiscountMode;
use Monobank\Acquiring\Enum\DiscountType;
use Monobank\Acquiring\Exception\InvalidBasketItemException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\ValueObject\BasketItem;
use Monobank\Acquiring\ValueObject\Discount;
use PHPUnit\Framework\TestCase;

class BasketItemTest extends TestCase
{
    public function testBlankName(): void
    {
        $this->expectException(InvalidBasketItemException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_BASKET_ITEM_CODE);
        $this->expectExceptionMessage('Basket order item name should not be blank.');

        new BasketItem('', 'code', 1, 100);
    }

    public function testBlankCode(): void
    {
        $this->expectException(InvalidBasketItemException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_BASKET_ITEM_CODE);
        $this->expectExceptionMessage('Basket order item code should not be blank.');

        new BasketItem('name', ' ', 1, 100);
    }

    public function testEmptyIcon(): void
    {
        $this->expectException(InvalidBasketItemException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_BASKET_ITEM_CODE);
        $this->expectExceptionMessage('Basket order item icon URL should not be blank.');

        $item = new BasketItem('name', 'code', 1, 100);
        $item->setIcon('');
    }

    public function testInvalidIconUrl(): void
    {
        $this->expectException(InvalidBasketItemException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_BASKET_ITEM_CODE);
        $this->expectExceptionMessage('Basket order item icon URL "test" is not a valid url.');

        $item = new BasketItem('name', 'code', 1, 100);
        $item->setIcon('test');
    }

    public function testRequiredParams(): void
    {
        $item = new BasketItem('name', 'code', 2, 100);

        self::assertEquals(
            [
                'name' => 'name',
                'code' => 'code',
                'qty' => 2,
                'sum' => 100,
                'total' => 200,
            ],
            $item->toArray(),
        );
    }

    public function testFullData(): void
    {
        $item = new BasketItem('name', 'code', 1, 100);
        $item->addTax(111)
            ->addTax(222)
            ->addTax(333)
            ->setBarcode('barcode')
            ->setFooter('footer')
            ->setHeader('header')
            ->setIcon('https://example.com/icon.png')
            ->setUnit('unit')
            ->setUktzed('uktzed')
            ->addDiscount(new Discount(DiscountType::DISCOUNT, DiscountMode::VALUE, 100))
            ->addDiscount(new Discount(DiscountType::EXTRA_CHARGE, DiscountMode::PERCENT, 200));

        self::assertEquals(
            [
                'name' => 'name',
                'code' => 'code',
                'qty' => 1,
                'sum' => 100,
                'total' => 100,
                'icon' => 'https://example.com/icon.png',
                'unit' => 'unit',
                'barcode' => 'barcode',
                'header' => 'header',
                'footer' => 'footer',
                'uktzed' => 'uktzed',
                'discounts' => [
                    [
                        'type' => 'DISCOUNT',
                        'mode' => 'VALUE',
                        'value' => 100.0,
                    ],
                    [
                        'type' => 'EXTRA_CHARGE',
                        'mode' => 'PERCENT',
                        'value' => 200.0,
                    ],
                ],
                'tax' => [111, 222, 333],
            ],
            $item->toArray(),
        );
    }
}
