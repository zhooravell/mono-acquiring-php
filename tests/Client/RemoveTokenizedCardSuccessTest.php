<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Client;

use Monobank\Acquiring\Request\RemoveTokenizedCardRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RemoveTokenizedCardSuccessTest extends BaseClientTestCase
{
    public function test(): void
    {
        $httpRequest = $this->createMock(RequestInterface::class);
        $httpRequest
            ->expects(self::any())
            ->method('withHeader')
            ->willReturn($httpRequest);

        $this->requestFactory
            ->expects(self::once())
            ->method('createRequest')
            ->with('DELETE', 'https://api.monobank.ua/api/merchant/wallet/card?cardToken=12345678')
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

        $this->client->removeTokenizedCard(new RemoveTokenizedCardRequest('12345678'));
    }
}
