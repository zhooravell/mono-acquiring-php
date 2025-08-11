<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Request;

use Monobank\Acquiring\Enum\DiscountMode;
use Monobank\Acquiring\Enum\DiscountType;
use Monobank\Acquiring\Exception\InvalidInvoiceIdException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\Request\CancelPaymentRequest;
use Monobank\Acquiring\Tests\Request\Traits\EmptyValueProviderTrait;
use Monobank\Acquiring\ValueObject\BasketItem;
use Monobank\Acquiring\ValueObject\Discount;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CancelPaymentRequestTest extends TestCase
{
    use EmptyValueProviderTrait;

    #[DataProvider('emptyStringProvider')]
    public function testEmptyInvoiceId($value): void
    {
        $this->expectException(InvalidInvoiceIdException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_INVOICE_ID_CODE);
        $this->expectExceptionMessage('Invoice Id should not be blank.');

        new CancelPaymentRequest($value);
    }

    public function testFullData(): void
    {
        $id = '123456789';
        $request = new CancelPaymentRequest($id);
        $request->setAmount(1000);
        $request->setExternalReference('external-reference');

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

        $request->addBasketItem($item);

        self::assertEquals(
            [
                'invoiceId' => $id,
                'amount' => 1000,
                'extRef' => 'external-reference',
                'items' => [
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
                        'tax' => [
                            111, 222, 333,
                        ],
                    ],
                ]
            ],
            $request->getPayload(),
        );
    }
}
