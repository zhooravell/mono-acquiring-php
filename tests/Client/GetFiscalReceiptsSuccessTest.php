<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Client;

use Monobank\Acquiring\Request\GetFiscalReceiptsRequest;
use Monobank\Acquiring\ValueObject\FiscalReceipt;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class GetFiscalReceiptsSuccessTest extends BaseClientTestCase
{
    public function test(): void
    {
        $content = [
            'checks' => [
                [
                    'id' => '1',
                    'type' => 'sale',
                    'status' => 'done',
                    'statusDescription' => null,
                    'file' => 'file-1',
                    'fiscalizationSource' => 'monopay',
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
            ->with('GET', 'https://api.monobank.ua/api/merchant/invoice/fiscal-checks?invoiceId=123')
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

        $response = $this->client->getFiscalReceipts(new GetFiscalReceiptsRequest("123"));
        $list = $response->getList();

        self::assertCount(1, $list);
        self::assertContainsOnlyInstancesOf(FiscalReceipt::class, $list);
    }
}
