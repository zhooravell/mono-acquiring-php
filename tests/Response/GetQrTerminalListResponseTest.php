<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Response;

use Monobank\Acquiring\Enum\QrTerminalAmountType;
use Monobank\Acquiring\Response\GetQrTerminalListResponse;
use Monobank\Acquiring\ValueObject\QrTerminal;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class GetQrTerminalListResponseTest extends TestCase
{
    #[DataProvider('emptyListProvider')]
    public function testEmptyList(array $data): void
    {
        $response = new GetQrTerminalListResponse($data);

        self::assertCount(0, $response->getList());
    }

    public static function emptyListProvider(): array
    {
        return [
            [[]],
            [['list' => []]]
        ];
    }

    public function testWithData(): void
    {
        $data = [
            'list' => [
                ['shortQrId' => 'shQrId_1', 'qrId' => 'qrId_1', 'amountType' => 'merchant', 'pageUrl' => 'pageUrl_1'],
                ['shortQrId' => 'shQrId_2', 'qrId' => 'qrId_2', 'amountType' => 'client', 'pageUrl' => 'pageUrl_2'],
                ['shortQrId' => 'shQrId_3', 'qrId' => 'qrId_3', 'amountType' => 'fix', 'pageUrl' => 'pageUrl_3'],
                ['shortQrId' => 'shQrId_4', 'qrId' => 'qrId_4', 'amountType' => 'test', 'pageUrl' => 'pageUrl_4'],
                ['shortQrId' => 'shQrId_5', 'qrId' => 'qrId_5', 'pageUrl' => 'pageUrl_5'],
            ],
        ];

        $response = new GetQrTerminalListResponse($data);
        $list = $response->getList();

        self::assertCount(5, $list);
        self::assertContainsOnlyInstancesOf(QrTerminal::class, $list);

        self::assertEquals('shQrId_1', $list[0]->getShortQrId());
        self::assertEquals('qrId_1', $list[0]->getQrId());
        self::assertEquals('pageUrl_1', $list[0]->getPageUrl());
        self::assertEquals(QrTerminalAmountType::MERCHANT, $list[0]->getAmountType());

        self::assertEquals('shQrId_2', $list[1]->getShortQrId());
        self::assertEquals('qrId_2', $list[1]->getQrId());
        self::assertEquals('pageUrl_2', $list[1]->getPageUrl());
        self::assertEquals(QrTerminalAmountType::CLIENT, $list[1]->getAmountType());

        self::assertEquals('shQrId_3', $list[2]->getShortQrId());
        self::assertEquals('qrId_3', $list[2]->getQrId());
        self::assertEquals('pageUrl_3', $list[2]->getPageUrl());
        self::assertEquals(QrTerminalAmountType::FIX, $list[2]->getAmountType());

        self::assertEquals('shQrId_4', $list[3]->getShortQrId());
        self::assertEquals('qrId_4', $list[3]->getQrId());
        self::assertEquals('pageUrl_4', $list[3]->getPageUrl());
        self::assertEquals(QrTerminalAmountType::UNKNOWN, $list[3]->getAmountType());

        self::assertEquals('shQrId_5', $list[4]->getShortQrId());
        self::assertEquals('qrId_5', $list[4]->getQrId());
        self::assertEquals('pageUrl_5', $list[4]->getPageUrl());
        self::assertEquals(QrTerminalAmountType::UNKNOWN, $list[4]->getAmountType());
    }
}
