<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Response;

use Monobank\Acquiring\Response\SubMerchantListResponse;
use Monobank\Acquiring\ValueObject\SubMerchant;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SubMerchantListResponseTest extends TestCase
{
    #[DataProvider('emptyListProvider')]
    public function testEmptyList(array $data): void
    {
        $response = new SubMerchantListResponse($data);

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
                ['code' => 'code_1', 'edrpou' => 'edrpou_1', 'iban' => 'iban_1', 'owner' => 'owner_1'],
                ['code' => 'code_2', 'edrpou' => 'edrpou_2', 'iban' => 'iban_2', 'owner' => 'owner_2'],
            ],
        ];

        $response = new SubMerchantListResponse($data);
        $list = $response->getList();

        self::assertCount(2, $list);
        self::assertContainsOnlyInstancesOf(SubMerchant::class, $list);

        self::assertEquals('code_1', $list[0]->getCode());
        self::assertEquals('edrpou_1', $list[0]->getEdrpou());
        self::assertEquals('iban_1', $list[0]->getIban());
        self::assertEquals('owner_1', $list[0]->getOwner());

        self::assertEquals('code_2', $list[1]->getCode());
        self::assertEquals('edrpou_2', $list[1]->getEdrpou());
        self::assertEquals('iban_2', $list[1]->getIban());
        self::assertEquals('owner_2', $list[1]->getOwner());
    }
}
