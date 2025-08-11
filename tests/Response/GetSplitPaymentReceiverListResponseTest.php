<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Response;

use Monobank\Acquiring\Response\GetSplitPaymentReceiverListResponse;
use Monobank\Acquiring\ValueObject\SplitReceiver;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class GetSplitPaymentReceiverListResponseTest extends TestCase
{
    #[DataProvider('emptyListProvider')]
    public function testEmptyList(array $data): void
    {
        $response = new GetSplitPaymentReceiverListResponse($data);

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
                ['splitReceiverId' => 'splitReceiverId_1', 'name' => 'ФОП Іван Мазепа'],
                ['splitReceiverId' => 'splitReceiverId_2', 'name' => 'ФОП Пилип Орлик'],
            ],
        ];

        $response = new GetSplitPaymentReceiverListResponse($data);
        $list = $response->getList();

        self::assertCount(2, $list);
        self::assertContainsOnlyInstancesOf(SplitReceiver::class, $list);

        self::assertEquals('splitReceiverId_1', $list[0]->getId());
        self::assertEquals('ФОП Іван Мазепа', $list[0]->getName());

        self::assertEquals('splitReceiverId_2', $list[1]->getId());
        self::assertEquals('ФОП Пилип Орлик', $list[1]->getName());
    }
}
