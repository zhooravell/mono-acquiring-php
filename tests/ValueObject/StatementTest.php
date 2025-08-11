<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use DateTimeImmutable;
use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Enum\InvoiceStatus;
use Monobank\Acquiring\Enum\PaymentScheme;
use Monobank\Acquiring\ValueObject\Statement;
use PHPUnit\Framework\TestCase;

class StatementTest extends TestCase
{
    public function testFullData(): void
    {
        $invoiceId = 'invoice-id';
        $status = InvoiceStatus::PROCESSING;
        $maskedPan = 'masked-pan';
        $date = new DateTimeImmutable('2025-07-20 12:00:00');
        $paymentScheme = PaymentScheme::FULL;
        $amount = 100;
        $profitAmount = 200;
        $currency = Currency::EUR;
        $approvalCode = 'approval-code';
        $rrn = 'rrn';
        $reference = 'reference';
        $shortQrId = 'short-qr-id';
        $destination = 'destination';
        $cancelList = [];

        $statement = new Statement(
            $invoiceId,
            $status,
            $maskedPan,
            $date,
            $paymentScheme,
            $amount,
            $profitAmount,
            $currency,
            $approvalCode,
            $rrn,
            $reference,
            $shortQrId,
            $destination,
            $cancelList,
        );

        self::assertSame($invoiceId, $statement->getInvoiceId());
        self::assertSame($status, $statement->getStatus());
        self::assertSame($maskedPan, $statement->getMaskedPan());
        self::assertSame($date, $statement->getDate());
        self::assertSame($paymentScheme, $statement->getPaymentScheme());
        self::assertSame($amount, $statement->getAmount());
        self::assertSame($profitAmount, $statement->getProfitAmount());
        self::assertSame($currency, $statement->getCurrency());
        self::assertSame($approvalCode, $statement->getApprovalCode());
        self::assertSame($rrn, $statement->getRrn());
        self::assertSame($reference, $statement->getReference());
        self::assertSame($shortQrId, $statement->getShortQrId());
        self::assertSame($destination, $statement->getDestination());
        self::assertSame($cancelList, $statement->getCancelList());
    }

    public function testWithoutData(): void
    {
        $statement = new Statement(
            null,
            InvoiceStatus::UNKNOWN,
            null,
            null,
            PaymentScheme::UNKNOWN,
            null,
            null,
            Currency::UNKNOWN,
            null,
            null,
            null,
            null,
            null,
            [],
        );

        self::assertNull($statement->getInvoiceId());
        self::assertSame(InvoiceStatus::UNKNOWN, $statement->getStatus());
        self::assertNull($statement->getMaskedPan());
        self::assertNull($statement->getDate());
        self::assertSame(PaymentScheme::UNKNOWN, $statement->getPaymentScheme());
        self::assertNull($statement->getAmount());
        self::assertNull($statement->getProfitAmount());
        self::assertSame(Currency::UNKNOWN, $statement->getCurrency());
        self::assertNull($statement->getApprovalCode());
        self::assertNull($statement->getRrn());
        self::assertNull($statement->getReference());
        self::assertNull($statement->getShortQrId());
        self::assertNull($statement->getDestination());
        self::assertEquals([], $statement->getCancelList());
    }
}
