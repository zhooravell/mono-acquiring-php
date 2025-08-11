<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\ValueObject\TipsInfo;
use PHPUnit\Framework\TestCase;

class TipsInfoTest extends TestCase
{
    public function testWithoutAmount(): void
    {
        $employeeId = 'employeeId';

        $tipsInfo = new TipsInfo($employeeId);

        self::assertSame($employeeId, $tipsInfo->getEmployeeId());
        self::assertNull($tipsInfo->getAmount());
    }

    public function testWithAmount(): void
    {
        $employeeId = 'employeeId';
        $amount = 333;

        $tipsInfo = new TipsInfo($employeeId, $amount);

        self::assertSame($employeeId, $tipsInfo->getEmployeeId());
        self::assertSame($amount, $tipsInfo->getAmount());
    }
}
