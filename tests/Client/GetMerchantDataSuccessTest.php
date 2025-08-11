<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Client;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class GetMerchantDataSuccessTest extends BaseClientTestCase
{
    public function test(): void
    {
        $merchantId = '12o4Vv7EWy';
        $merchantName = 'Your Favourite Company';
        $edrpou = '4242424242';

        $httpRequest = $this->createMock(RequestInterface::class);
        $httpRequest
            ->expects(self::any())
            ->method('withHeader')
            ->willReturn($httpRequest);

        $this->requestFactory
            ->expects(self::once())
            ->method('createRequest')
            ->with('GET', 'https://api.monobank.ua/api/merchant/details')
            ->willReturn($httpRequest);

        $response = $this->createMock(ResponseInterface::class);
        $response->expects(self::any())
            ->method('getStatusCode')
            ->willReturn(200);

        $stream = $this->createMock(StreamInterface::class);
        $stream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode([
                'merchantId' => $merchantId,
                'merchantName' => $merchantName,
                'edrpou' => $edrpou,
            ]));

        $response->expects(self::any())
            ->method('getBody')
            ->willReturn($stream);

        $this->httpClient
            ->expects(self::once())
            ->method('sendRequest')
            ->with($httpRequest)
            ->willReturn($response);

        $response = $this->client->getMerchantData();

        self::assertEquals($merchantId, $response->getMerchantId());
        self::assertEquals($merchantName, $response->getMerchantName());
        self::assertEquals($edrpou, $response->getEDRPOU());
    }
}
