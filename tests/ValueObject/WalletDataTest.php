<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\Enum\TokenizedCardStatus;
use Monobank\Acquiring\ValueObject\WalletData;
use PHPUnit\Framework\TestCase;

class WalletDataTest extends TestCase
{
    public function testWithoutStatus(): void
    {
        $cardToken = 'cardToken';
        $walletId = 'walletId';

        $walletData = new WalletData($cardToken, $walletId);

        self::assertSame($cardToken, $walletData->getCardToken());
        self::assertSame($walletId, $walletData->getWalletId());
        self::assertSame(TokenizedCardStatus::UNKNOWN, $walletData->getStatus());
    }

    public function testWithStatus(): void
    {
        $cardToken = 'cardToken';
        $walletId = 'walletId';

        $walletData = new WalletData($cardToken, $walletId, TokenizedCardStatus::NEW);

        self::assertSame($cardToken, $walletData->getCardToken());
        self::assertSame($walletId, $walletData->getWalletId());
        self::assertSame(TokenizedCardStatus::NEW, $walletData->getStatus());
    }
}
