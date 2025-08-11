<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Response;

use Monobank\Acquiring\Enum\CancellationStatus;
use Monobank\Acquiring\Response\CancelPaymentResponse;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CancelPaymentResponseTest extends TestCase
{
    #[DataProvider('validDataProvider')]
    public function testValidData(string $status, string $createdDate, string $modifiedDate): void
    {
        $response = new CancelPaymentResponse(
            [
                'status' => $status,
                'createdDate' => $createdDate,
                'modifiedDate' => $modifiedDate,
            ],
        );

        self::assertEquals($status, $response->getStatus()->value);
        self::assertEquals($createdDate, $response->getCreatedDate()->format('Y-m-d\TH:i:s\Z'));
        self::assertEquals($modifiedDate, $response->getModifiedDate()->format('Y-m-d\TH:i:s\Z'));
    }

    public static function validDataProvider(): array
    {
        return [
            ['processing', '2019-08-24T14:15:22Z', '2019-08-24T14:15:22Z'],
        ];
    }

    public function testNoData(): void
    {
        $response = new CancelPaymentResponse([]);

        self::assertEquals(CancellationStatus::UNKNOWN, $response->getStatus());
        self::assertNull($response->getCreatedDate());
        self::assertNull($response->getModifiedDate());
    }

    public function testInvalidStatus(): void
    {
        $response = new CancelPaymentResponse(['status' => 'invalidStatus']);

        self::assertEquals(CancellationStatus::UNKNOWN, $response->getStatus());
    }

    public function testInvalidCreatedDate(): void
    {
        $response = new CancelPaymentResponse(['createdDate' => 'invalidDate']);

        self::assertNull($response->getCreatedDate());
    }

    public function testInvalidModifiedDate(): void
    {
        $response = new CancelPaymentResponse(['modifiedDate' => 'invalidDate']);

        self::assertNull($response->getModifiedDate());
    }
}
