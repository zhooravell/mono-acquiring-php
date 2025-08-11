<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Client;

use Monobank\Acquiring\Client;
use Monobank\Acquiring\Exception\BadRequestException;
use Monobank\Acquiring\Exception\ForbiddenException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\Exception\NotFoundException;
use Monobank\Acquiring\Exception\TooManyRequestsException;
use Monobank\Acquiring\Exception\UnexpectedException;
use Monobank\Acquiring\InvoiceCreatorInterface;
use Monobank\Acquiring\ValueObject\APIToken;
use Monobank\Acquiring\ValueObject\Cms;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Monobank\Acquiring\ClientInterface as ApiClientInterface;

class BaseClientTestCase extends TestCase
{
    protected ApiClientInterface $client;
    protected ClientInterface $httpClient;
    protected RequestFactoryInterface $requestFactory;
    protected StreamFactoryInterface $streamFactory;

    public static function errorsDataProvider(): array
    {
        return [
            [
                400,
                'BAD_REQUEST',
                'Error message!!!',
                BadRequestException::class,
                MonobankAcquiringException::BAD_REQUEST_ERROR_CODE,
            ],
            [
                403,
                'FORBIDDEN',
                'Error message!!!',
                ForbiddenException::class,
                MonobankAcquiringException::FORBIDDEN_CODE,
            ],
            [
                404,
                'NOT_FOUND',
                'Error message!!!',
                NotFoundException::class,
                MonobankAcquiringException::NOT_FOUND_CODE,
            ],
            [
                429,
                'TOO_MANY_REQUESTS',
                'Error message!!!',
                TooManyRequestsException::class,
                MonobankAcquiringException::TOO_MANY_REQUEST_CODE,
            ],
            [
                500,
                'INTERNAL_SERVER_ERROR',
                'Error message!!!',
                InvoiceCreatorInterface::class,
                MonobankAcquiringException::INTERNAL_SERVER_ERROR_CODE,
            ],
            [
                405,
                'bla bla',
                'Error message!!!',
                UnexpectedException::class,
                MonobankAcquiringException::UNEXPECTED_ERROR_CODE,
            ],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->httpClient = $this->createMock(ClientInterface::class);
        $this->requestFactory = $this->createMock(RequestFactoryInterface::class);
        $this->streamFactory = $this->createMock(StreamFactoryInterface::class);

        $this->client = new Client(
            $this->httpClient,
            $this->requestFactory,
            $this->streamFactory,
            new APIToken('qwerty'),
            new Cms(),
        );
    }
}
