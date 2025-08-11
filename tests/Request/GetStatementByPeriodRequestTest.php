<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Request;

use DateTime;
use Monobank\Acquiring\Exception\InvalidTerminalCodeException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\Request\GetStatementByPeriodRequest;
use Monobank\Acquiring\Tests\Request\Traits\EmptyValueProviderTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class GetStatementByPeriodRequestTest extends TestCase
{
    use EmptyValueProviderTrait;

    public function testWithFromDate(): void
    {
        $request = new GetStatementByPeriodRequest(new DateTime('2025-07-25 13:00:00'));

        self::assertEquals(
            [
                'from' => 1753448400,
            ],
            $request->getPayload(),
        );
    }

    public function testWithFullData(): void
    {
        $request = new GetStatementByPeriodRequest(new DateTime('2025-07-25 13:00:00'));
        $request->setToDate(new DateTime('2025-07-25 15:00:00'));
        $request->setTerminalCode('12345');

        self::assertEquals(
            [
                'from' => 1753448400,
                'to' => 1753455600,
                'code' => '12345',
            ],
            $request->getPayload(),
        );
    }

    #[DataProvider('emptyStringProvider')]
    public function testEmptyCode($value): void
    {
        $this->expectException(InvalidTerminalCodeException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_TERMINAL_CODE);
        $this->expectExceptionMessage('Terminal code should not be blank.');

        $request = new GetStatementByPeriodRequest(new DateTime('2025-07-25 13:00:00'));
        $request->setTerminalCode($value);
    }
}
