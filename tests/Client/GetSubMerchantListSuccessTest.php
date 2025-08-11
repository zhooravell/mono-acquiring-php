<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Client;

use Monobank\Acquiring\ValueObject\SubMerchant;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class GetSubMerchantListSuccessTest extends BaseClientTestCase
{
    public function test(): void
    {
        $content = [
            'list' => [
                ['code' => 'code_1', 'edrpou' => 'edrpou_1', 'iban' => 'iban_1', 'owner' => 'owner_1'],
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
            ->with('GET', 'https://api.monobank.ua/api/merchant/submerchant/list')
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

        $response = $this->client->getSubMerchantList();
        $list = $response->getList();

        self::assertCount(1, $list);
        self::assertContainsOnlyInstancesOf(SubMerchant::class, $list);
    }
}
