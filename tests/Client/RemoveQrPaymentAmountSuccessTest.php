<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Client;

use Monobank\Acquiring\Request\RemoveQrPaymentAmountRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class RemoveQrPaymentAmountSuccessTest extends BaseClientTestCase
{
    public function test(): void
    {
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
            ->with('POST', 'https://api.monobank.ua/api/merchant/qr/reset-amount')
            ->willReturn($httpRequest);

        $response = $this->createMock(ResponseInterface::class);
        $response->expects(self::any())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->httpClient
            ->expects(self::once())
            ->method('sendRequest')
            ->with($httpRequest)
            ->willReturn($response);

        $this->client->removeQrPaymentAmount(new RemoveQrPaymentAmountRequest('12345678'));
    }
}
