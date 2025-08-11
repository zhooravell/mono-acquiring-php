<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Client;

use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Request\GetQrTerminalInfoRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class GetQrTerminalInfoSuccessTest extends BaseClientTestCase
{
    public function test(): void
    {
        $shortQrId = 'OBJE';
        $invoiceId = '4EwIUTA12JIZ';
        $amount = 4200;
        $ccy = 980;

        $httpRequest = $this->createMock(RequestInterface::class);
        $httpRequest
            ->expects(self::any())
            ->method('withHeader')
            ->willReturn($httpRequest);

        $this->requestFactory
            ->expects(self::once())
            ->method('createRequest')
            ->with('GET', 'https://api.monobank.ua/api/merchant/qr/details?qrId=123')
            ->willReturn($httpRequest);

        $response = $this->createMock(ResponseInterface::class);
        $response->expects(self::any())
            ->method('getStatusCode')
            ->willReturn(200);

        $stream = $this->createMock(StreamInterface::class);
        $stream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode([
                'shortQrId' => $shortQrId,
                'invoiceId' => $invoiceId,
                'amount' => $amount,
                'ccy' => $ccy,
            ]));

        $response->expects(self::any())
            ->method('getBody')
            ->willReturn($stream);

        $this->httpClient
            ->expects(self::once())
            ->method('sendRequest')
            ->with($httpRequest)
            ->willReturn($response);

        $response = $this->client->getQrTerminalInfo(new GetQrTerminalInfoRequest("123"));

        self::assertEquals($shortQrId, $response->getShortQrId());
        self::assertEquals($invoiceId, $response->getInvoiceId());
        self::assertEquals($amount, $response->getAmount());
        self::assertEquals(Currency::UAH, $response->getCurrency());
    }
}
