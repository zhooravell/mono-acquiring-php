<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use DateTimeImmutable;
use Monobank\Acquiring\Enum\CancellationStatus;
use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\ValueObject\CancelListItem;
use PHPUnit\Framework\TestCase;

class CancelListItemTest extends TestCase
{
    public function testWithData(): void
    {
        $status = CancellationStatus::SUCCESS;
        $amount = 123;
        $currency = Currency::UAH;
        $createdDate = new DateTimeImmutable('2025-07-16 12:33:45');
        $modifiedDate = new DateTimeImmutable('2025-07-20 10:12:15');
        $approvalCode = '662476';
        $rrn = '060189181768';
        $extRef = '635ace02599849e981b2cd7a65f417fe';

        $item = new CancelListItem(
            $status,
            $amount,
            $currency,
            $createdDate,
            $modifiedDate,
            $approvalCode,
            $rrn,
            $extRef,
        );

        self::assertSame($status, $item->getStatus());
        self::assertSame($amount, $item->getAmount());
        self::assertSame($currency, $item->getCurrency());
        self::assertSame($createdDate, $item->getCreatedDate());
        self::assertSame($modifiedDate, $item->getModifiedDate());
        self::assertSame($approvalCode, $item->getApprovalCode());
        self::assertSame($rrn, $item->getRrn());
        self::assertSame($extRef, $item->getExternalReference());
    }

    public function testNoData(): void
    {
        $item = new CancelListItem(
            CancellationStatus::UNKNOWN,
            null,
            Currency::UNKNOWN,
            null,
            null,
            null,
            null,
            null,
        );

        self::assertSame(CancellationStatus::UNKNOWN, $item->getStatus());
        self::assertNull($item->getAmount());
        self::assertSame(Currency::UNKNOWN, $item->getCurrency());
        self::assertNull($item->getCreatedDate());
        self::assertNull($item->getModifiedDate());
        self::assertNull($item->getApprovalCode());
        self::assertNull($item->getRrn());
        self::assertNull($item->getExternalReference());
    }
}
