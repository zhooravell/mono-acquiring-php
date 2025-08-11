<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Client;

use DateTime;
use Monobank\Acquiring\Request\GetStatementByPeriodRequest;
use Monobank\Acquiring\ValueObject\Statement;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class GetStatementByPeriodSuccessTest extends BaseClientTestCase
{
    public function test(): void
    {
        $json = <<<'JSON'
{
  "list": [
    {
      "invoiceId": "2205175v4MfatvmUL2oR",
      "status": "success",
      "maskedPan": "444403******1902",
      "date": "2025-07-25 13:30:00",
      "paymentScheme": "full",
      "amount": 4200,
      "profitAmount": 4100,
      "ccy": 980,
      "approvalCode": "662476",
      "rrn": "060189181768",
      "reference": "84d0070ee4e44667b31371d8f8813947",
      "shortQrId": "OBJE",
      "destination": "Покупка щастя",
      "cancelList": [
        {
          "amount": 4200,
          "ccy": 980,
          "date": "2025-07-25 13:45:00",
          "approvalCode": "662476",
          "rrn": "060189181768",
          "maskedPan": "444403******1902"
        }
      ]
    }
  ]
}
JSON;

        $httpRequest = $this->createMock(RequestInterface::class);
        $httpRequest
            ->expects(self::any())
            ->method('withHeader')
            ->willReturn($httpRequest);

        $this->requestFactory
            ->expects(self::once())
            ->method('createRequest')
            ->with('GET', 'https://api.monobank.ua/api/merchant/statement?from=1753448400')
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

        $response = $this->client->getStatementByPeriod(
            new GetStatementByPeriodRequest(new DateTime('2025-07-25 13:00:00')),
        );

        self::assertContainsOnlyInstancesOf(Statement::class, $response->getList());
        self::assertCount(1, $response->getList());
    }
}
