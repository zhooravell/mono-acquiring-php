<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\Exception\InvalidCardException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\ValueObject\Card;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    public function testToArray(): void
    {
        $card = new Card('4242424242424242', '0642', '123');

        self::assertEquals(
            [
                'pan' => '4242424242424242',
                'exp' => '0642',
                'cvv' => '123',
            ],
            $card->toArray(),
        );
    }

    #[DataProvider('emptyStringProvider')]
    public function testBlankCardNumber(string $value): void
    {
        $this->expectException(InvalidCardException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_CARD_DATA_CODE);
        $this->expectExceptionMessage('Card number should not be blank.');

        new Card($value, '123', '123');
    }

    #[DataProvider('emptyStringProvider')]
    public function testBlankCardExp(string $value): void
    {
        $this->expectException(InvalidCardException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_CARD_DATA_CODE);
        $this->expectExceptionMessage('Card expiration date should not be blank.');

        new Card('123', $value, '123');
    }

    #[DataProvider('emptyStringProvider')]
    public function testBlankCardCVV(string $value): void
    {
        $this->expectException(InvalidCardException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_CARD_DATA_CODE);
        $this->expectExceptionMessage('Card cvv should not be blank.');

        new Card('123', '1036', $value);
    }

    #[DataProvider('invalidExpProvider')]
    public function testInvalidCardExp(string $value): void
    {
        $this->expectException(InvalidCardException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_CARD_DATA_CODE);
        $this->expectExceptionMessage('Card expiration date should follow the "MMYY" format.');

        new Card('123', $value, '123');
    }

    #[DataProvider('invalidCVVProvider')]
    public function testInvalidCardCvv(string $value): void
    {
        $this->expectException(InvalidCardException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_CARD_DATA_CODE);
        $this->expectExceptionMessage('Invalid card cvv.');

        new Card('123', '1225', $value);
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

    public static function invalidExpProvider(): array
    {
        return [
            ['123'],
            ['test'],
            ['1w3e'],
            ['3333'],
            ['1999'],
            ['222222'],
        ];
    }

    public static function invalidCVVProvider(): array
    {
        return [
            ['test'],
            ['11dd'],
            ['aa444'],
        ];
    }
}
