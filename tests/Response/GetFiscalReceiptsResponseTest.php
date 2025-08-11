<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Response;

use Monobank\Acquiring\Enum\FiscalizationSource;
use Monobank\Acquiring\Enum\FiscalReceiptStatus;
use Monobank\Acquiring\Enum\FiscalReceiptType;
use Monobank\Acquiring\Response\GetFiscalReceiptsResponse;
use Monobank\Acquiring\ValueObject\FiscalReceipt;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class GetFiscalReceiptsResponseTest extends TestCase
{
    #[DataProvider('emptyListProvider')]
    public function testEmptyList(array $data): void
    {
        $response = new GetFiscalReceiptsResponse($data);

        self::assertCount(0, $response->getList());
    }

    public static function emptyListProvider(): array
    {
        return [
            [[]],
            [['checks' => []]]
        ];
    }

    public function testWithData(): void
    {
        $data = [
            'checks' => [
                [
                    'id' => '1',
                    'type' => 'sale',
                    'status' => 'done',
                    'statusDescription' => null,
                    'file' => 'file-1',
                    'fiscalizationSource' => 'monopay',
                ],
                [
                    'id' => '2',
                    'type' => 'return',
                    'status' => 'process',
                    'statusDescription' => '',
                    'file' => 'file-2',
                    'fiscalizationSource' => 'checkbox',
                ],
                [
                    'id' => '3',
                    'type' => 'sale',
                    'status' => 'failed',
                    'statusDescription' => 'description',
                    'file' => 'file-3',
                    'fiscalizationSource' => 'vchasnokasa',
                ],
                [
                    'id' => null,
                    'type' => null,
                    'status' => null,
                    'statusDescription' => null,
                    'file' => null,
                    'fiscalizationSource' => null,
                ],
                [],
            ],
        ];

        $response = new GetFiscalReceiptsResponse($data);
        $list = $response->getList();

        self::assertCount(5, $list);
        self::assertContainsOnlyInstancesOf(FiscalReceipt::class, $list);

        self::assertEquals('1', $list[0]->getId());
        self::assertEquals(FiscalReceiptType::SALE, $list[0]->getType());
        self::assertEquals(FiscalReceiptStatus::DONE, $list[0]->getStatus());
        self::assertEquals('', $list[0]->getStatusDescription());
        self::assertEquals('file-1', $list[0]->getFile());
        self::assertEquals(FiscalizationSource::MONOPAY, $list[0]->getFiscalizationSource());

        self::assertEquals('2', $list[1]->getId());
        self::assertEquals(FiscalReceiptType::RETURN, $list[1]->getType());
        self::assertEquals(FiscalReceiptStatus::PROCESS, $list[1]->getStatus());
        self::assertEquals('', $list[1]->getStatusDescription());
        self::assertEquals('file-2', $list[1]->getFile());
        self::assertEquals(FiscalizationSource::CHECKBOX, $list[1]->getFiscalizationSource());

        self::assertEquals('3', $list[2]->getId());
        self::assertEquals(FiscalReceiptType::SALE, $list[2]->getType());
        self::assertEquals(FiscalReceiptStatus::FAILED, $list[2]->getStatus());
        self::assertEquals('description', $list[2]->getStatusDescription());
        self::assertEquals('file-3', $list[2]->getFile());
        self::assertEquals(FiscalizationSource::VCHASNOKASA, $list[2]->getFiscalizationSource());

        self::assertEquals('', $list[3]->getId());
        self::assertEquals(FiscalReceiptType::UNKNOWN, $list[3]->getType());
        self::assertEquals(FiscalReceiptStatus::UNKNOWN, $list[3]->getStatus());
        self::assertEquals('', $list[3]->getStatusDescription());
        self::assertEquals('', $list[3]->getFile());
        self::assertEquals(FiscalizationSource::UNKNOWN, $list[3]->getFiscalizationSource());

        self::assertEquals('', $list[4]->getId());
        self::assertEquals(FiscalReceiptType::UNKNOWN, $list[4]->getType());
        self::assertEquals(FiscalReceiptStatus::UNKNOWN, $list[4]->getStatus());
        self::assertEquals('', $list[4]->getStatusDescription());
        self::assertEquals('', $list[4]->getFile());
        self::assertEquals(FiscalizationSource::UNKNOWN, $list[4]->getFiscalizationSource());
    }
}
