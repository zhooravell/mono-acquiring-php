<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Client;

use Monobank\Acquiring\Exception\ForbiddenException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\Request\CancelPaymentRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class CancelPaymentFailureTest extends BaseClientTestCase
{
    #[DataProvider('errorsDataProvider')]
    public function test(
        int $httpStatusCode,
        string $errorCode,
        string $errorMessage,
        string $exceptionClass,
        int $exceptionCode,
    ): void {
        $this->expectException($exceptionClass);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode($exceptionCode);
        $this->expectExceptionMessage($errorMessage);

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
            ->with('POST', 'https://api.monobank.ua/api/merchant/invoice/cancel')
            ->willReturn($httpRequest);

        $response = $this->createMock(ResponseInterface::class);
        $response->expects(self::any())
            ->method('getStatusCode')
            ->willReturn($httpStatusCode);

        $stream = $this->createMock(StreamInterface::class);
        $stream->expects(self::any())
            ->method('getContents')
            ->willReturn(json_encode(['errCode' => $errorCode, 'errText' => $errorMessage]));

        $response->expects(self::any())
            ->method('getBody')
            ->willReturn($stream);

        $this->httpClient
            ->expects(self::once())
            ->method('sendRequest')
            ->with($httpRequest)
            ->willReturn($response);

        try {
            $this->client->cancelPayment(new CancelPaymentRequest('12345678'));
        } catch (ForbiddenException $e) {
            self::assertSame($errorCode, $e->getErrorCode());

            throw $e;
        }
    }
}
