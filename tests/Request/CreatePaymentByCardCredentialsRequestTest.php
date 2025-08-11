<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Request;

use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Enum\InitiationKind;
use Monobank\Acquiring\Enum\PaymentType;
use Monobank\Acquiring\Request\CreatePaymentByCardCredentialsRequest;
use Monobank\Acquiring\ValueObject\Card;
use PHPUnit\Framework\TestCase;

class CreatePaymentByCardCredentialsRequestTest extends TestCase
{
    public function testRequiredData(): void
    {
        $card = new Card('4242424242424242', '1235', '123');
        $request = new CreatePaymentByCardCredentialsRequest(100, Currency::EUR, $card, InitiationKind::CLIENT);

        self::assertEquals(
            [
                'amount' => 100,
                'ccy' => 978,
                'cardData' => [
                    'pan' => '4242424242424242',
                    'exp' => '1235',
                    'cvv' => '123',
                ],
                'initiationKind' => 'client',
                'paymentType' => 'debit',
            ],
            $request->getPayload(),
        );
    }

    public function testFullData(): void
    {
        $card = new Card('4242424242424242', '1235', '123');
        $request = new CreatePaymentByCardCredentialsRequest(100, Currency::EUR, $card, InitiationKind::MERCHANT);
        $request->setWebHookUrl('https://example.com/webhook');
        $request->setRedirectUrl('https://example.com/redirect');
        $request->setPaymentType(PaymentType::Hold);
        $request->setSaveCardData(true, 'wallet-1');
        $request->setReference('reference-1');
        $request->setDestination('destination-1');
        $request->setComment('comment-1');
        $request->addEmail('test@test.com');

        self::assertEquals(
            [
                'amount' => 100,
                'ccy' => 978,
                'cardData' => [
                    'pan' => '4242424242424242',
                    'exp' => '1235',
                    'cvv' => '123',
                ],
                'initiationKind' => 'merchant',
                'paymentType' => 'hold',
                'webHookUrl' => 'https://example.com/webhook',
                'redirectUrl' => 'https://example.com/redirect',
                'saveCardData' => [
                    'saveCard' => true,
                    'walletId' => 'wallet-1',
                ],
                'merchantPaymInfo' => [
                    'reference' => 'reference-1',
                    'destination' => 'destination-1',
                    'comment' => 'comment-1',
                    'customerEmails' => [
                        'test@test.com',
                    ]
                ],
            ],
            $request->getPayload(),
        );
    }
}
