<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\Exception\InvalidBaseUrlException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\ValueObject\BaseUrl;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class BaseUrlTest extends TestCase
{
    public function testValidAPIToken(): void
    {
        $value = 'https://api.monobank.ua/';
        $token = new BaseUrl($value);

        self::assertEquals($token, $token->__toString());
    }

    public function testInvalidUrl(): void
    {
        $this->expectException(InvalidBaseUrlException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_BASE_URL_CODE);
        $this->expectExceptionMessage('Base url "test" is not a valid url.');

        new BaseUrl('test');
    }

    #[DataProvider('emptyStringProvider')]
    public function testEmptyValue($value): void
    {
        $this->expectException(InvalidBaseUrlException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_BASE_URL_CODE);
        $this->expectExceptionMessage('Base url should not be blank.');

        new BaseUrl($value);
    }

    public static function emptyStringProvider(): array
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
