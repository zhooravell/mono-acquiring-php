<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Client;

use Monobank\Acquiring\ValueObject\QrTerminal;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class GetQrTerminalListSuccessTest extends BaseClientTestCase
{
    public function test(): void
    {
        $content = [
            'list' => [
                [
                    'shortQrId' => 'shortQrId_1',
                    'qrId' => 'qrId_1',
                    'amountType' => 'merchant',
                    'pageUrl' => 'pageUrl_1',
                ],
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
            ->with('GET', 'https://api.monobank.ua/api/merchant/qr/list')
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

        $response = $this->client->getQrTerminalList();
        $list = $response->getList();

        self::assertCount(1, $list);
        self::assertContainsOnlyInstancesOf(QrTerminal::class, $list);
    }
}
