<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Request;

use Monobank\Acquiring\Exception\InvalidCardTokenException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\Request\RemoveTokenizedCardRequest;
use Monobank\Acquiring\Tests\Request\Traits\EmptyValueProviderTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RemoveTokenizedCardRequestTest extends TestCase
{
    use EmptyValueProviderTrait;

    #[DataProvider('emptyStringProvider')]
    public function testEmptyCardToken($value): void
    {
        $this->expectException(InvalidCardTokenException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_CARD_TOKEN_CODE);
        $this->expectExceptionMessage('Card token should not be blank.');

        new RemoveTokenizedCardRequest($value);
    }

    public function testValidCardToken(): void
    {
        $token = '123456789';
        $request = new RemoveTokenizedCardRequest($token);

        self::assertEquals(
            [
                'cardToken' => $token,
            ],
            $request->getPayload(),
        );
    }
}
