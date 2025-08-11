<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Request;

use Monobank\Acquiring\Exception\InvalidWalletIdException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\Request\GetCardsRequest;
use Monobank\Acquiring\Tests\Request\Traits\EmptyValueProviderTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class GetCardsRequestTest extends TestCase
{
    use EmptyValueProviderTrait;

    #[DataProvider('emptyStringProvider')]
    public function testEmptyWalletId($value): void
    {
        $this->expectException(InvalidWalletIdException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_WALLET_ID_CODE);
        $this->expectExceptionMessage('Wallet ID should not be blank.');

        new GetCardsRequest($value);
    }

    public function testValidWalletId(): void
    {
        $id = '123456789';
        $request = new GetCardsRequest($id);

        self::assertEquals(
            [
                'walletId' => $id,
            ],
            $request->getPayload(),
        );
    }
}
