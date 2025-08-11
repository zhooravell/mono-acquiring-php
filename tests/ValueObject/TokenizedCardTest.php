<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\Enum\Country;
use Monobank\Acquiring\ValueObject\TokenizedCard;
use PHPUnit\Framework\TestCase;

class TokenizedCardTest extends TestCase
{
    public function testWithoutCountry(): void
    {
        $cardToken = 'card_token';
        $maskedPan = 'masked_pan';

        $card = new TokenizedCard($cardToken, $maskedPan);

        self::assertSame($cardToken, $card->getCardToken());
        self::assertSame($maskedPan, $card->getMaskedPan());
        self::assertSame(Country::UNKNOWN, $card->getCountry());
    }

    public function testWithCountry(): void
    {
        $cardToken = 'card_token';
        $maskedPan = 'masked_pan';

        $card = new TokenizedCard($cardToken, $maskedPan, Country::UKRAINE);

        self::assertSame($cardToken, $card->getCardToken());
        self::assertSame($maskedPan, $card->getMaskedPan());
        self::assertSame(Country::UKRAINE, $card->getCountry());
    }
}
