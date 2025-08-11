<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Response;

use Monobank\Acquiring\Enum\CancellationStatus;
use Monobank\Acquiring\Enum\Country;
use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Enum\InvoiceStatus;
use Monobank\Acquiring\Enum\PaymentMethod;
use Monobank\Acquiring\Enum\PaymentSystem;
use Monobank\Acquiring\Enum\TokenizedCardStatus;
use Monobank\Acquiring\Response\CreateSyncPaymentResponse;
use Monobank\Acquiring\ValueObject\CancelListItem;
use PHPUnit\Framework\TestCase;

class CreateSyncPaymentResponseTest extends TestCase
{
    public function testWithoutData(): void
    {
        $response = new CreateSyncPaymentResponse([]);

        self::assertNull($response->getInvoiceId());
        self::assertEquals(InvoiceStatus::UNKNOWN, $response->getStatus());
        self::assertEquals(Currency::UNKNOWN, $response->getCurrency());
        self::assertNull($response->getFailureReason());
        self::assertNull($response->getErrorCode());
        self::assertNull($response->getAmount());
        self::assertNull($response->getFinalAmount());
        self::assertNull($response->getCreatedDate());
        self::assertNull($response->getModifiedDate());
        self::assertNull($response->getReference());
        self::assertNull($response->getDestination());
        self::assertEquals([], $response->getCancelList());
        self::assertNull($response->getPaymentInfo()->getMaskedPan());
        self::assertNull($response->getPaymentInfo()->getApprovalCode());
        self::assertNull($response->getPaymentInfo()->getRrn());
        self::assertNull($response->getPaymentInfo()->getTransactionId());
        self::assertNull($response->getPaymentInfo()->getTerminal());
        self::assertNull($response->getPaymentInfo()->getFee());
        self::assertNull($response->getPaymentInfo()->getFee());
        self::assertNull($response->getPaymentInfo()->getAgentFee());
        self::assertNull($response->getWalletData()->getWalletId());
        self::assertNull($response->getWalletData()->getCardToken());
        self::assertNull($response->getTipsInfo()->getEmployeeId());
        self::assertNull($response->getTipsInfo()->getAmount());
    }

    public function testWithData(): void
    {
        $data = [
            'invoiceId' => 'p2_9ZgpZVsl3',
            'status' => 'created',
            'failureReason' => 'Неправильний CVV код',
            'errCode' => '59',
            'amount' => 4200,
            'ccy' => 980,
            'finalAmount' => 4200,
            'createdDate' => '2025-07-17T12:00:00+03:00',
            'modifiedDate' => '2025-07-17T12:30:00+03:00',
            'reference' => '84d0070ee4e44667b31371d8f8813947',
            'destination' => 'Покупка щастя',
            'cancelList' => [
                [
                    'status' => 'processing',
                    'amount' => 4200,
                    'ccy' => 980,
                    'createdDate' => '2025-07-17T12:00:00+03:00',
                    'modifiedDate' => '2025-07-17T13:00:00+03:00',
                    'approvalCode' => '662476',
                    'rrn' => '060189181768',
                    'extRef' => '635ace02599849e981b2cd7a65f417fe',
                ],
                [
                    'amount' => 4200,
                    'createdDate' => 'test',
                    'modifiedDate' => 'test',
                    'approvalCode' => '662476',
                    'rrn' => '060189181768',
                    'extRef' => '635ace02599849e981b2cd7a65f417fe',
                ],
            ],
            'paymentInfo' => [
                'maskedPan' => '444403******1902',
                'approvalCode' => '662476',
                'rrn' => '060189181768',
                'tranId' => '13194036',
                'terminal' => 'MI001088',
                'bank' => 'Універсал Банк',
                'paymentSystem' => 'visa',
                'paymentMethod' => 'monobank',
                'fee' => null,
                'country' => '804',
                'agentFee' => null,
            ],
            'walletData' => [
                'cardToken' => '67XZtXdR4NpKU3',
                'walletId' => 'c1376a611e17b059aeaf96b73258da9c',
                'status' => 'new',
            ],
            'tipsInfo' => [
                'employeeId' => 'employee-123',
                'amount' => 4200,
            ],
        ];

        $response = new CreateSyncPaymentResponse($data);

        self::assertEquals('p2_9ZgpZVsl3', $response->getInvoiceId());
        self::assertEquals(InvoiceStatus::CREATED, $response->getStatus());
        self::assertEquals('Неправильний CVV код', $response->getFailureReason());
        self::assertEquals('59', $response->getErrorCode());
        self::assertEquals(4200, $response->getAmount());
        self::assertEquals(Currency::UAH, $response->getCurrency());
        self::assertEquals(4200, $response->getFinalAmount());
        self::assertEquals('2025-07-17 12:00:00', $response->getCreatedDate()->format('Y-m-d H:i:s'));
        self::assertEquals('2025-07-17 12:30:00', $response->getModifiedDate()->format('Y-m-d H:i:s'));
        self::assertEquals('84d0070ee4e44667b31371d8f8813947', $response->getReference());
        self::assertEquals('Покупка щастя', $response->getDestination());
        self::assertCount(2, $response->getCancelList());
        self::assertContainsOnlyInstancesOf(CancelListItem::class, $response->getCancelList());

        $item1 = $response->getCancelList()[0];

        self::assertEquals(CancellationStatus::PROCESSING, $item1->getStatus());
        self::assertEquals(4200, $item1->getAmount());
        self::assertEquals(Currency::UAH, $item1->getCurrency());
        self::assertEquals('662476', $item1->getApprovalCode());
        self::assertEquals('635ace02599849e981b2cd7a65f417fe', $item1->getExternalReference());
        self::assertEquals('2025-07-17 12:00:00', $item1->getCreatedDate()->format('Y-m-d H:i:s'));
        self::assertEquals('2025-07-17 13:00:00', $item1->getModifiedDate()->format('Y-m-d H:i:s'));

        $item2 = $response->getCancelList()[1];

        self::assertEquals(CancellationStatus::UNKNOWN, $item2->getStatus());
        self::assertEquals(4200, $item2->getAmount());
        self::assertEquals(Currency::UNKNOWN, $item2->getCurrency());
        self::assertEquals('662476', $item2->getApprovalCode());
        self::assertEquals('635ace02599849e981b2cd7a65f417fe', $item2->getExternalReference());
        self::assertNull($item2->getCreatedDate());
        self::assertNull($item2->getModifiedDate());

        self::assertEquals(PaymentSystem::VISA, $response->getPaymentInfo()->getPaymentSystem());
        self::assertEquals(PaymentMethod::MONOBANK, $response->getPaymentInfo()->getPaymentMethod());
        self::assertEquals('444403******1902', $response->getPaymentInfo()->getMaskedPan());
        self::assertEquals('662476', $response->getPaymentInfo()->getApprovalCode());
        self::assertEquals('060189181768', $response->getPaymentInfo()->getRrn());
        self::assertEquals('13194036', $response->getPaymentInfo()->getTransactionId());
        self::assertEquals('MI001088', $response->getPaymentInfo()->getTerminal());
        self::assertEquals('Універсал Банк', $response->getPaymentInfo()->getBank());
        self::assertEquals(Country::UKRAINE, $response->getPaymentInfo()->getCountry());
        self::assertNull($response->getPaymentInfo()->getAgentFee());
        self::assertNull($response->getPaymentInfo()->getFee());

        self::assertEquals(TokenizedCardStatus::NEW, $response->getWalletData()->getStatus());
        self::assertEquals('67XZtXdR4NpKU3', $response->getWalletData()->getCardToken());
        self::assertEquals('c1376a611e17b059aeaf96b73258da9c', $response->getWalletData()->getWalletId());

        self::assertEquals('employee-123', $response->getTipsInfo()->getEmployeeId());
        self::assertEquals(4200, $response->getTipsInfo()->getAmount());
    }
}
