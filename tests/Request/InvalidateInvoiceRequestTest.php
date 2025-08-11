<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Request;

use Monobank\Acquiring\Exception\InvalidInvoiceIdException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\Request\InvalidateInvoiceRequest;
use Monobank\Acquiring\Tests\Request\Traits\EmptyValueProviderTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class InvalidateInvoiceRequestTest extends TestCase
{
    use EmptyValueProviderTrait;

    #[DataProvider('emptyStringProvider')]
    public function testEmptyInvoiceId($value): void
    {
        $this->expectException(InvalidInvoiceIdException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_INVOICE_ID_CODE);
        $this->expectExceptionMessage('Invoice Id should not be blank.');

        new InvalidateInvoiceRequest($value);
    }

    public function testValidInvoiceId(): void
    {
        $id = '123456789';
        $request = new InvalidateInvoiceRequest($id);

        self::assertEquals(
            [
                'invoiceId' => $id,
            ],
            $request->getPayload(),
        );
    }
}
