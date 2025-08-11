<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Request;

use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Enum\InitiationKind;
use Monobank\Acquiring\Exception\InvalidCardTokenException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\Request\CreateTokenPaymentRequest;
use Monobank\Acquiring\Tests\Request\Traits\EmptyValueProviderTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CreateTokenPaymentRequestTest extends TestCase
{
    use EmptyValueProviderTrait;

    #[DataProvider('requiredParamsProvider')]
    public function testRequiredParams(
        string $cardToken,
        int $amount,
        Currency $currency,
        InitiationKind $initiationKind,
    ): void {
        $request = new CreateTokenPaymentRequest($cardToken, $amount, $currency, $initiationKind);

        self::assertEquals(
            [
                'cardToken' => $cardToken,
                'amount' => $amount,
                'ccy' => $currency->value,
                'initiationKind' => $initiationKind->value,
            ],
            $request->getPayload()
        );
    }

    public static function requiredParamsProvider(): array
    {
        return [
            ['token-1', 100, Currency::UAH, InitiationKind::CLIENT],
            ['token-2', 200, Currency::EUR, InitiationKind::MERCHANT],
        ];
    }

    #[DataProvider('emptyStringProvider')]
    public function testEmptyCardToken($value): void
    {
        $this->expectException(InvalidCardTokenException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_CARD_TOKEN_CODE);
        $this->expectExceptionMessage('Card token should not be blank.');

        new CreateTokenPaymentRequest($value, 100, Currency::UAH, InitiationKind::CLIENT);
    }
}
