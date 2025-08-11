<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Client;

use Monobank\Acquiring\Exception\ForbiddenException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use PHPUnit\Framework\Attributes\DataProvider;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class GetPublicKeyFailureTest extends BaseClientTestCase
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

        $httpRequest = $this->createMock(RequestInterface::class);
        $httpRequest
            ->expects(self::any())
            ->method('withHeader')
            ->willReturn($httpRequest);

        $this->requestFactory
            ->expects(self::once())
            ->method('createRequest')
            ->with('GET', 'https://api.monobank.ua/api/merchant/pubkey')
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
            $this->client->getPublicKey();
        } catch (ForbiddenException $e) {
            self::assertSame($errorCode, $e->getErrorCode());

            throw $e;
        }
    }
}
