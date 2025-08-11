<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\Enum\MerchantInitiatedTransactionIndicator;
use Monobank\Acquiring\Enum\SyncPaymentCardType;
use Monobank\Acquiring\Exception\InvalidCardException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\ValueObject\SyncPaymentCard;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SyncPaymentCardTest extends TestCase
{
    public function testRequiredData(): void
    {
        $card = new SyncPaymentCard(
            '4242424242424242',
            '0642',
            SyncPaymentCardType::DPAN,
            'eciIndicator-1',
        );

        self::assertEquals(
            [
                'pan' => '4242424242424242',
                'type' => 'DPAN',
                'exp' => '0642',
                'eciIndicator' => 'eciIndicator-1',
            ],
            $card->toArray(),
        );
    }

    public function testFullData(): void
    {
        $card = new SyncPaymentCard(
            '4242424242424242',
            '0642',
            SyncPaymentCardType::DPAN,
            'eciIndicator-1',
        );
        $card->setCvv('1234');
        $card->setMerchantInitiatedTransactionIndicator(MerchantInitiatedTransactionIndicator::MERCHANT);
        $card->setTid('tid-1');
        $card->setSst('sst-1');
        $card->setTReqID('treq-1');
        $card->setDsTranId('dstranid-1');
        $card->setTavv('tavv-1');
        $card->setCavv('cavv-1');

        self::assertEquals(
            [
                'pan' => '4242424242424242',
                'type' => 'DPAN',
                'exp' => '0642',
                'eciIndicator' => 'eciIndicator-1',
                'cvv' => '1234',
                'mit' => '1',
                'tid' => 'tid-1',
                'sst' => 'sst-1',
                'tReqID' => 'treq-1',
                'dsTranId' => 'dstranid-1',
                'tavv' => 'tavv-1',
                'cavv' => 'cavv-1',
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

        new SyncPaymentCard($value, '0512', SyncPaymentCardType::DPAN, 'eciIndicator-1');
    }

    #[DataProvider('emptyStringProvider')]
    public function testBlankCardExp(string $value): void
    {
        $this->expectException(InvalidCardException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_CARD_DATA_CODE);
        $this->expectExceptionMessage('Card expiration date should not be blank.');

        new SyncPaymentCard('4242424242424242', $value, SyncPaymentCardType::DPAN, 'eciIndicator-1');
    }

    #[DataProvider('invalidExpProvider')]
    public function testInvalidCardExp(string $value): void
    {
        $this->expectException(InvalidCardException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_CARD_DATA_CODE);
        $this->expectExceptionMessage('Card expiration date should follow the "MMYY" format.');

        new SyncPaymentCard('4242424242424242', $value, SyncPaymentCardType::FPAN, 'eciIndicator-1');
    }

    #[DataProvider('emptyStringProvider')]
    public function testBlankEciIndicator(string $value): void
    {
        $this->expectException(InvalidCardException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_CARD_DATA_CODE);
        $this->expectExceptionMessage('eciIndicator should not be blank.');

        new SyncPaymentCard('4242424242424242', '0512', SyncPaymentCardType::DPAN, $value);
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
}
