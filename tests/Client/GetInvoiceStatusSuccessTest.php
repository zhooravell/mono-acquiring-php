<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Client;

use Monobank\Acquiring\Request\GetInvoiceStatusRequest;
use Monobank\Acquiring\ValueObject\CancelListItem;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class GetInvoiceStatusSuccessTest extends BaseClientTestCase
{
    public function test(): void
    {
        $content = [
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

        $httpRequest = $this->createMock(RequestInterface::class);
        $httpRequest
            ->expects(self::any())
            ->method('withHeader')
            ->willReturn($httpRequest);

        $this->requestFactory
            ->expects(self::once())
            ->method('createRequest')
            ->with('GET', 'https://api.monobank.ua/api/merchant/invoice/status?invoiceId=123')
            ->willReturn($httpRequest);

        $response = $this->createMock(ResponseInterface::class);
        $response->expects(self::any())
            ->method('getStatusCode')
            ->willReturn(200);

        $stream = $this->createMock(StreamInterface::class);
        $stream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode($content));

        $response->expects(self::any())
            ->method('getBody')
            ->willReturn($stream);

        $this->httpClient
            ->expects(self::once())
            ->method('sendRequest')
            ->with($httpRequest)
            ->willReturn($response);

        $response = $this->client->getInvoiceStatus(new GetInvoiceStatusRequest("123"));

        self::assertSame('p2_9ZgpZVsl3', $response->getInvoiceId());
        self::assertCount(1, $response->getCancelList());
        self::assertContainsOnlyInstancesOf(CancelListItem::class, $response->getCancelList());
    }
}
