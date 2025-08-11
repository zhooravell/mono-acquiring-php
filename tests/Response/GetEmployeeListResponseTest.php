<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Response;

use Monobank\Acquiring\Response\GetEmployeeListResponse;
use Monobank\Acquiring\ValueObject\Employee;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class GetEmployeeListResponseTest extends TestCase
{
    #[DataProvider('emptyListProvider')]
    public function testEmptyList(array $data): void
    {
        $response = new GetEmployeeListResponse($data);

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
                ['id' => '1', 'name' => 'Лесь Курбас', 'extRef' => '123'],
                ['id' => '2', 'name' => 'Тичина Павло Григорович', 'extRef' => '456'],
            ],
        ];

        $response = new GetEmployeeListResponse($data);
        $list = $response->getList();

        self::assertCount(2, $list);
        self::assertContainsOnlyInstancesOf(Employee::class, $list);

        self::assertEquals('1', $list[0]->getId());
        self::assertEquals('Лесь Курбас', $list[0]->getName());
        self::assertEquals('123', $list[0]->getExtRef());

        self::assertEquals('2', $list[1]->getId());
        self::assertEquals('Тичина Павло Григорович', $list[1]->getName());
        self::assertEquals('456', $list[1]->getExtRef());
    }
}
