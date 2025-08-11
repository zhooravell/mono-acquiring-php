<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Client;

use Monobank\Acquiring\Request\GetCardsRequest;
use Monobank\Acquiring\ValueObject\TokenizedCard;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class GetCardsSuccessTest extends BaseClientTestCase
{
    public function test(): void
    {
        $content = [
            'wallet' => [
                ['cardToken' => '67XZtXdR4NpKU1', 'maskedPan' => '424242******4242', 'country' => '804'],
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
            ->with('GET', 'https://api.monobank.ua/api/merchant/wallet?walletId=1234')
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

        $response = $this->client->getCards(new GetCardsRequest('1234'));
        $list = $response->getList();

        self::assertCount(1, $list);
        self::assertContainsOnlyInstancesOf(TokenizedCard::class, $list);
    }
}
