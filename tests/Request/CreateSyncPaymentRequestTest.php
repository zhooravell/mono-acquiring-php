<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Request;

use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Enum\SyncPaymentCardType;
use Monobank\Acquiring\Request\CreateSyncPaymentRequest;
use Monobank\Acquiring\ValueObject\ApplePayData;
use Monobank\Acquiring\ValueObject\GooglePayData;
use Monobank\Acquiring\ValueObject\SyncPaymentCard;
use PHPUnit\Framework\TestCase;

class CreateSyncPaymentRequestTest extends TestCase
{
    public function testWithRequiredData(): void
    {
        $request = new CreateSyncPaymentRequest(100, Currency::EUR);

        self::assertEquals(
            [
                'amount' => 100,
                'ccy' => 978,
            ],
            $request->getPayload(),
        );
    }

    public function testWithFullData(): void
    {
        $request = new CreateSyncPaymentRequest(100, Currency::EUR);
        $request->setCardData(new SyncPaymentCard(
            '4242424242424242',
            '0642',
            SyncPaymentCardType::FPAN,
            'eciIndicator',
        ));
        $request->setApplePayData(new ApplePayData('token-1', '1235', 'eciIndicator-1'));
        $request->setGooglePayData(new GooglePayData('token-2', '1025', 'eciIndicator-2'));

        self::assertEquals(
            [
                'amount' => 100,
                'ccy' => 978,
                'cardData' => [
                    'pan' => '4242424242424242',
                    'exp' => '0642',
                    'type' => 'FPAN',
                    'eciIndicator' => 'eciIndicator',
                ],
                'applePay' => [
                    'token' => 'token-1',
                    'exp' => '1235',
                    'eciIndicator' => 'eciIndicator-1',
                ],
                'googlePay' => [
                    'token' => 'token-2',
                    'exp' => '1025',
                    'eciIndicator' => 'eciIndicator-2',
                ]
            ],
            $request->getPayload(),
        );
    }
}
