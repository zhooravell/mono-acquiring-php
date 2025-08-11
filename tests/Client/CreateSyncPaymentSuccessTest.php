<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Client;

use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Enum\InitiationKind;
use Monobank\Acquiring\Request\CreatePaymentByCardCredentialsRequest;
use Monobank\Acquiring\Request\CreateSyncPaymentRequest;
use Monobank\Acquiring\ValueObject\Card;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class CreateSyncPaymentSuccessTest extends BaseClientTestCase
{
    public function test(): void
    {
        $json = <<<'JSON'
{
  "invoiceId": "p2_9ZgpZVsl3",
  "status": null,
  "failureReason": "Неправильний CVV код",
  "errCode": "59",
  "amount": 4200,
  "ccy": 980,
  "finalAmount": 4200,
  "createdDate": null,
  "modifiedDate": null,
  "reference": "84d0070ee4e44667b31371d8f8813947",
  "destination": "Покупка щастя",
  "cancelList": [
    {
      "status": null,
      "amount": 4200,
      "ccy": 980,
      "createdDate": null,
      "modifiedDate": null,
      "approvalCode": "662476",
      "rrn": "060189181768",
      "extRef": "635ace02599849e981b2cd7a65f417fe"
    }
  ],
  "paymentInfo": {
    "maskedPan": "444403******1902",
    "approvalCode": "662476",
    "rrn": "060189181768",
    "tranId": "13194036",
    "terminal": "MI001088",
    "bank": "Універсал Банк",
    "paymentSystem": "visa",
    "paymentMethod": null,
    "fee": null,
    "country": "804",
    "agentFee": null
  },
  "walletData": {
    "cardToken": "67XZtXdR4NpKU3",
    "walletId": "c1376a611e17b059aeaf96b73258da9c",
    "status": null
  },
  "tipsInfo": {
    "employeeId": null,
    "amount": 4200
  }
}
JSON;

        $this->streamFactory
            ->expects(self::once())
            ->method('createStream')
            ->willReturn($this->createMock(StreamInterface::class));

        $httpRequest = $this->createMock(RequestInterface::class);
        $httpRequest
            ->expects(self::any())
            ->method('withHeader')
            ->willReturn($httpRequest);

        $httpRequest
            ->expects(self::once())
            ->method('withBody')
            ->willReturn($httpRequest);

        $this->requestFactory
            ->expects(self::once())
            ->method('createRequest')
            ->with('POST', 'https://api.monobank.ua/api/merchant/invoice/sync-payment')
            ->willReturn($httpRequest);

        $response = $this->createMock(ResponseInterface::class);
        $response->expects(self::any())
            ->method('getStatusCode')
            ->willReturn(200);

        $stream = $this->createMock(StreamInterface::class);
        $stream->expects(self::any())
            ->method('getContents')
            ->willReturn($json);

        $response->expects(self::any())
            ->method('getBody')
            ->willReturn($stream);

        $this->httpClient
            ->expects(self::once())
            ->method('sendRequest')
            ->with($httpRequest)
            ->willReturn($response);

        $result = $this->client->createSyncPayment(new CreateSyncPaymentRequest(1000, Currency::UAH));

        self::assertEquals('p2_9ZgpZVsl3', $result->getInvoiceId());
    }
}
