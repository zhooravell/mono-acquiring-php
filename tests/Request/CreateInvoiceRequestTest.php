<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Request;

use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Enum\DiscountMode;
use Monobank\Acquiring\Enum\DiscountType;
use Monobank\Acquiring\Enum\PaymentType;
use Monobank\Acquiring\Exception\InvalidCommentException;
use Monobank\Acquiring\Exception\InvalidDestinationException;
use Monobank\Acquiring\Exception\InvalidEmailException;
use Monobank\Acquiring\Exception\InvalidEmployeeIdException;
use Monobank\Acquiring\Exception\InvalidQRIdException;
use Monobank\Acquiring\Exception\InvalidRedirectUrlException;
use Monobank\Acquiring\Exception\InvalidTerminalCodeException;
use Monobank\Acquiring\Exception\InvalidValidityTimeException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\Request\CreateInvoiceRequest;
use Monobank\Acquiring\Tests\Request\Traits\EmptyValueProviderTrait;
use Monobank\Acquiring\ValueObject\BasketItem;
use Monobank\Acquiring\ValueObject\Discount;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CreateInvoiceRequestTest extends TestCase
{
    use EmptyValueProviderTrait;

    #[DataProvider('requiredParamsProvider')]
    public function testRequiredParams(int $amount, PaymentType $paymentType): void
    {
        $request = new CreateInvoiceRequest($amount, $paymentType);

        self::assertEquals(
            [
                'amount' => $amount,
                'paymentType' => $paymentType->value,
            ],
            $request->getPayload()
        );
    }

    public static function requiredParamsProvider(): array
    {
        return [
            [100, PaymentType::Debit],
            [250, PaymentType::Hold],
        ];
    }

    #[DataProvider('emptyStringProvider')]
    public function testEmptyRedirectUrl(string $value): void
    {
        $this->expectException(InvalidRedirectUrlException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_REDIRECT_URL_CODE);
        $this->expectExceptionMessage('Redirect URL should not be blank.');

        $request = new CreateInvoiceRequest(100, PaymentType::Debit);
        $request->setRedirectUrl($value);
    }

    public function testInvalidRedirectUrl(): void
    {
        $this->expectException(InvalidRedirectUrlException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_REDIRECT_URL_CODE);
        $this->expectExceptionMessage('Redirect URL "test" is not a valid url.');

        $request = new CreateInvoiceRequest(100, PaymentType::Debit);
        $request->setRedirectUrl('test');
    }

    #[DataProvider('emptyStringProvider')]
    public function testEmptyWebHookUrl(string $value): void
    {
        $this->expectException(InvalidRedirectUrlException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_WEBHOOK_URL_CODE);
        $this->expectExceptionMessage('Webhook should not be blank.');

        $request = new CreateInvoiceRequest(100, PaymentType::Debit);
        $request->setWebHookUrl($value);
    }

    public function testInvalidWebHookUrl(): void
    {
        $this->expectException(InvalidRedirectUrlException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_WEBHOOK_URL_CODE);
        $this->expectExceptionMessage('Webhook "test" is not a valid url.');

        $request = new CreateInvoiceRequest(100, PaymentType::Debit);
        $request->setWebHookUrl('test');
    }

    #[DataProvider('emptyStringProvider')]
    public function testEmptyQRId(string $value): void
    {
        $this->expectException(InvalidQRIdException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_QR_ID_CODE);
        $this->expectExceptionMessage('QR Id should not be blank.');

        $request = new CreateInvoiceRequest(100, PaymentType::Debit);
        $request->setQRId($value);
    }

    #[DataProvider('emptyStringProvider')]
    public function testEmptyTerminalCode(string $value): void
    {
        $this->expectException(InvalidTerminalCodeException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_TERMINAL_CODE);
        $this->expectExceptionMessage('Terminal code should not be blank.');

        $request = new CreateInvoiceRequest(100, PaymentType::Debit);
        $request->setTerminalCode($value);
    }

    #[DataProvider('emptyStringProvider')]
    public function testEmptyTipsEmployeeId(string $value): void
    {
        $this->expectException(InvalidEmployeeIdException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_EMPLOYEE_ID_CODE);
        $this->expectExceptionMessage('Employee ID should not be blank.');

        $request = new CreateInvoiceRequest(100, PaymentType::Debit);
        $request->setTipsEmployeeId($value);
    }

    public function testEmptyValidity(): void
    {
        $this->expectException(InvalidValidityTimeException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_VALIDITY_TIME_CODE);
        $this->expectExceptionMessage('Validity time should be greater than zero.');

        $request = new CreateInvoiceRequest(100, PaymentType::Debit);
        $request->setValidity(0);
    }

    public function testDestinationMaxLength(): void
    {
        $this->expectException(InvalidDestinationException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_DESTINATION_CODE);
        $this->expectExceptionMessage('Destination cannot be longer than 280 characters.');

        $request = new CreateInvoiceRequest(100, PaymentType::Debit);
        $request->setDestination(str_repeat('A', 290));
    }

    public function testCommentMaxLength(): void
    {
        $this->expectException(InvalidCommentException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_COMMENT_CODE);
        $this->expectExceptionMessage('Comment cannot be longer than 280 characters.');

        $request = new CreateInvoiceRequest(100, PaymentType::Debit);
        $request->setComment(str_repeat('A', 290));
    }

    public function testInvalidEmail(): void
    {
        $this->expectException(InvalidEmailException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_EMAIL_CODE);
        $this->expectExceptionMessage('The email qwerty is not a valid email.');

        $request = new CreateInvoiceRequest(100, PaymentType::Debit);
        $request->addEmail('qwerty');
    }

    public function testFullData(): void
    {
        $request = new CreateInvoiceRequest(100);
        $request->setPaymentType(PaymentType::Hold);
        $request->setCurrency(Currency::UAH);
        $request->setValidity(3600);
        $request->setWebHookUrl('https://example.com/webhook');
        $request->setRedirectUrl('https://example.com/redirect');
        $request->setQRId('qr_id');
        $request->setTerminalCode('terminal_code');
        $request->setTipsEmployeeId('employee_id');
        $request->addEmail('test@example.com');
        $request->setComment('comment');
        $request->setDestination('destination');
        $request->setReference('reference');
        $request->setAgentFeePercent(1.5);
        $request->setSaveCardData(true, 'walletId');
        $request->addDiscount(new Discount(DiscountType::DISCOUNT, DiscountMode::PERCENT, 1));

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
                'amount' => 100,
                'paymentType' => 'hold',
                'ccy' => 980,
                'validity' => 3600,
                'webHookUrl' => 'https://example.com/webhook',
                'redirectUrl' => 'https://example.com/redirect',
                'qrId' => 'qr_id',
                'code' => 'terminal_code',
                'tipsEmployeeId' => 'employee_id',
                'merchantPaymInfo' => [
                    'comment' => 'comment',
                    'destination' => 'destination',
                    'reference' => 'reference',
                    'customerEmails' => [
                        'test@example.com',
                    ],
                    'discounts' => [
                        [
                            'type' => 'DISCOUNT',
                            'mode' => 'PERCENT',
                            'value' => 1.0,
                        ],
                    ],
                    'basketOrder' => [
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
                    ],
                ],
                'agentFeePercent' => 1.5,
                'saveCardData' => [
                    'saveCard' => true,
                    'walletId' => 'walletId',
                ],
            ],
            $request->getPayload(),
        );
    }

    public function testPartialData(): void
    {
        $request = new CreateInvoiceRequest(100);
        $request->setPaymentType(PaymentType::Hold);
        $request->setCurrency(Currency::UAH);
        $request->setValidity(3600);
        $request->setWebHookUrl('https://example.com/webhook');
        $request->setRedirectUrl('https://example.com/redirect');
        $request->setQRId('qr_id');
        $request->setTerminalCode('terminal_code');
        $request->setTipsEmployeeId('employee_id');
        $request->setComment('comment');
        $request->setDestination('destination');
        $request->setReference('reference');
        $request->setAgentFeePercent(1.5);

        self::assertEquals(
            [
                'amount' => 100,
                'paymentType' => 'hold',
                'ccy' => 980,
                'validity' => 3600,
                'webHookUrl' => 'https://example.com/webhook',
                'redirectUrl' => 'https://example.com/redirect',
                'qrId' => 'qr_id',
                'code' => 'terminal_code',
                'tipsEmployeeId' => 'employee_id',
                'merchantPaymInfo' => [
                    'comment' => 'comment',
                    'destination' => 'destination',
                    'reference' => 'reference',
                ],
                'agentFeePercent' => 1.5,
            ],
            $request->getPayload(),
        );
    }
}
