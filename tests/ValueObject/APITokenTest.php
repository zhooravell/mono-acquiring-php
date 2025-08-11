<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\Exception\InvalidAPITokenException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\ValueObject\APIToken;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class APITokenTest extends TestCase
{
    /**
     * @throws InvalidAPITokenException
     */
    public function testValidAPIToken(): void
    {
        $value = 'qwerty';
        $token = new APIToken($value);

        self::assertEquals($token, $token->__toString());
    }

    #[DataProvider('emptyAPITokenProvider')]
    public function testEmptyAPIToken($value): void
    {
        $this->expectException(InvalidAPITokenException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_API_TOKEN_CODE);
        $this->expectExceptionMessage('API Token should not be blank.');

        new APIToken($value);
    }

    public static function emptyAPITokenProvider(): array
    {
        return [
            [''],
            ['   '],
            ["\n"],
            ["\t"],
            ["\t\n\t"],
        ];
    }
}
