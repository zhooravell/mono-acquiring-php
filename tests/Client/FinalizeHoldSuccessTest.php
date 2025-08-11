<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Client;

use Monobank\Acquiring\Enum\FinalizeStatus;
use Monobank\Acquiring\Request\FinalizeHoldRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class FinalizeHoldSuccessTest extends BaseClientTestCase
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
            ->with('POST', 'https://api.monobank.ua/api/merchant/invoice/finalize')
            ->willReturn($httpRequest);

        $response = $this->createMock(ResponseInterface::class);
        $response->expects(self::any())
            ->method('getStatusCode')
            ->willReturn(200);

        $stream = $this->createMock(StreamInterface::class);
        $stream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode(['status' => 'success']));

        $response->expects(self::any())
            ->method('getBody')
            ->willReturn($stream);

        $this->httpClient
            ->expects(self::once())
            ->method('sendRequest')
            ->with($httpRequest)
            ->willReturn($response);

        $result = $this->client->finalizeHold(new FinalizeHoldRequest('invoice_id_1', 123));

        self::assertEquals(FinalizeStatus::SUCCESS, $result->getStatus());
    }
}
