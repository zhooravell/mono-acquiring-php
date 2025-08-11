<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Client;

use Monobank\Acquiring\Request\CreateInvoiceRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class CreateInvoiceSuccessTest extends BaseClientTestCase
{
    public function test(): void
    {
        $invoiceId = 'invoice_id_1';
        $pageUrl = 'https://example.com/page';

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
            ->with('POST', 'https://api.monobank.ua/api/merchant/invoice/create')
            ->willReturn($httpRequest);

        $response = $this->createMock(ResponseInterface::class);
        $response->expects(self::any())
            ->method('getStatusCode')
            ->willReturn(200);

        $stream = $this->createMock(StreamInterface::class);
        $stream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode(['invoiceId' => $invoiceId, 'pageUrl' => $pageUrl]));

        $response->expects(self::any())
            ->method('getBody')
            ->willReturn($stream);

        $this->httpClient
            ->expects(self::once())
            ->method('sendRequest')
            ->with($httpRequest)
            ->willReturn($response);

        $result = $this->client->createInvoice(new CreateInvoiceRequest(1000));

        self::assertEquals($invoiceId, $result->getInvoiceId());
        self::assertEquals($pageUrl, $result->getPageUrl());
    }
}
