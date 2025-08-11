<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use DateTimeImmutable;
use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\ValueObject\CancelOperation;
use PHPUnit\Framework\TestCase;

class CancelOperationTest extends TestCase
{
    public function testWithData(): void
    {
        $amount = 100;
        $currency = Currency::UAH;
        $date = new DateTimeImmutable('2025-07-25 20:00:00');
        $approvalCode = 'approval-code';
        $rrn = 'rrn';
        $maskedPan = 'masked-pan';

        $cancelOperation = new CancelOperation(
            $amount,
            $currency,
            $date,
            $approvalCode,
            $rrn,
            $maskedPan,
        );

        self::assertSame($amount, $cancelOperation->getAmount());
        self::assertSame($currency, $cancelOperation->getCurrency());
        self::assertSame($date, $cancelOperation->getDate());
        self::assertSame($approvalCode, $cancelOperation->getApprovalCode());
        self::assertSame($rrn, $cancelOperation->getRRN());
        self::assertSame($maskedPan, $cancelOperation->getMaskedPan());
    }

    public function testWithoutData(): void
    {
        $cancelOperation = new CancelOperation(
            null,
            Currency::UNKNOWN,
            null,
            null,
            null,
            null,
        );

        self::assertNull($cancelOperation->getAmount());
        self::assertSame(Currency::UNKNOWN, $cancelOperation->getCurrency());
        self::assertNull($cancelOperation->getDate());
        self::assertNull($cancelOperation->getApprovalCode());
        self::assertNull($cancelOperation->getRRN());
        self::assertNull($cancelOperation->getMaskedPan());
    }
}
