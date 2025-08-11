<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Response;

use Monobank\Acquiring\Enum\Country;
use Monobank\Acquiring\Response\GetCardsResponse;
use Monobank\Acquiring\ValueObject\TokenizedCard;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class GetCardsResponseTest extends TestCase
{
    #[DataProvider('emptyListProvider')]
    public function testEmptyList(array $data): void
    {
        $response = new GetCardsResponse($data);

        self::assertCount(0, $response->getList());
    }

    public static function emptyListProvider(): array
    {
        return [
            [[]],
            [['wallet' => []]]
        ];
    }

    public function testWithData(): void
    {
        $data = [
            'wallet' => [
                ['cardToken' => '67XZtXdR4NpKU1', 'maskedPan' => '424242******4242', 'country' => '804'],
                ['cardToken' => '67XZtXdR4NpKU2', 'maskedPan' => '424242******4242', 'country' => 804],
                ['cardToken' => '67XZtXdR4NpKU3', 'maskedPan' => '424242******4242', 'country' => null],
                ['cardToken' => '67XZtXdR4NpKU4', 'maskedPan' => '424242******4242'],
            ],
        ];

        $response = new GetCardsResponse($data);
        $list = $response->getList();

        self::assertCount(4, $list);
        self::assertContainsOnlyInstancesOf(TokenizedCard::class, $list);

        self::assertEquals('67XZtXdR4NpKU1', $list[0]->getCardToken());
        self::assertEquals('424242******4242', $list[0]->getMaskedPan());
        self::assertEquals(Country::UKRAINE, $list[0]->getCountry());

        self::assertEquals('67XZtXdR4NpKU2', $list[1]->getCardToken());
        self::assertEquals('424242******4242', $list[1]->getMaskedPan());
        self::assertEquals(Country::UKRAINE, $list[1]->getCountry());

        self::assertEquals('67XZtXdR4NpKU3', $list[2]->getCardToken());
        self::assertEquals('424242******4242', $list[2]->getMaskedPan());
        self::assertEquals(Country::UNKNOWN, $list[2]->getCountry());

        self::assertEquals('67XZtXdR4NpKU4', $list[3]->getCardToken());
        self::assertEquals('424242******4242', $list[3]->getMaskedPan());
        self::assertEquals(Country::UNKNOWN, $list[3]->getCountry());
    }
}
