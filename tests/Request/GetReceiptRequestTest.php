<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Request;

use Monobank\Acquiring\Exception\InvalidEmailException;
use Monobank\Acquiring\Exception\InvalidInvoiceIdException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\Request\GetReceiptRequest;
use Monobank\Acquiring\Tests\Request\Traits\EmptyValueProviderTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class GetReceiptRequestTest extends TestCase
{
    use EmptyValueProviderTrait;

    #[DataProvider('emptyStringProvider')]
    public function testEmptyInvoiceId($value): void
    {
        $this->expectException(InvalidInvoiceIdException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_INVOICE_ID_CODE);
        $this->expectExceptionMessage('Invoice Id should not be blank.');

        new GetReceiptRequest($value);
    }

    public function testInvalidEmail(): void
    {
        $this->expectException(InvalidEmailException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_EMAIL_CODE);
        $this->expectExceptionMessage('The email qwerty is not a valid email.');

        $request = new GetReceiptRequest('123456789');
        $request->setEmail('qwerty');
    }


    public function testValidInvoiceId(): void
    {
        $id = '123456789';
        $request = new GetReceiptRequest($id);

        self::assertEquals(
            [
                'invoiceId' => $id,
            ],
            $request->getPayload(),
        );
    }

    public function testFullDays(): void
    {
        $id = '123456789';
        $email = 'test@example.com';
        $request = new GetReceiptRequest($id);
        $request->setEmail($email);

        self::assertEquals(
            [
                'invoiceId' => $id,
                'email' => $email,
            ],
            $request->getPayload(),
        );
    }
}
