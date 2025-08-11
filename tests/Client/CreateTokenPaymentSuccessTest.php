<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Client;

use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Enum\InitiationKind;
use Monobank\Acquiring\Request\CreateTokenPaymentRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class CreateTokenPaymentSuccessTest extends BaseClientTestCase
{
    public function test(): void
    {
        $json = <<<'JSON'
{
  "invoiceId": "2210012MPLYwJjVUzchj",
  "tdsUrl": "https://example.com/tds/url",
  "status": "success",
  "failureReason": "Неправильний CVV код",
  "amount": 4200,
  "ccy": 980,
  "createdDate": null,
  "modifiedDate": null
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
            ->with('POST', 'https://api.monobank.ua/api/merchant/wallet/payment')
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

        $result = $this->client->createTokenPayment(new CreateTokenPaymentRequest(
            'token-1',
            100,
            Currency::UAH,
            InitiationKind::CLIENT
        ));

        self::assertEquals('2210012MPLYwJjVUzchj', $result->getInvoiceId());
    }
}
