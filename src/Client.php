<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use JsonException;
use Monobank\Acquiring\Exception\BadRequestException;
use Monobank\Acquiring\Exception\ForbiddenException;
use Monobank\Acquiring\Exception\InternalServerErrorException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\Exception\NotFoundException;
use Monobank\Acquiring\Exception\TooManyRequestsException;
use Monobank\Acquiring\Exception\UnexpectedException;
use Monobank\Acquiring\Request\CreateInvoiceRequest;
use Monobank\Acquiring\Request\CancelPaymentRequest;
use Monobank\Acquiring\Request\CreatePaymentByCardCredentialsRequest;
use Monobank\Acquiring\Request\CreateSyncPaymentRequest;
use Monobank\Acquiring\Request\CreateTokenPaymentRequest;
use Monobank\Acquiring\Request\FinalizeHoldRequest;
use Monobank\Acquiring\Request\GetCardsRequest;
use Monobank\Acquiring\Request\GetFiscalReceiptsRequest;
use Monobank\Acquiring\Request\GetInvoiceStatusRequest;
use Monobank\Acquiring\Request\GetQrTerminalInfoRequest;
use Monobank\Acquiring\Request\GetReceiptRequest;
use Monobank\Acquiring\Request\GetStatementByPeriodRequest;
use Monobank\Acquiring\Request\InvalidateInvoiceRequest;
use Monobank\Acquiring\Request\RemoveQrPaymentAmountRequest;
use Monobank\Acquiring\Request\RemoveTokenizedCardRequest;
use Monobank\Acquiring\Response\CreateInvoiceResponse;
use Monobank\Acquiring\Response\CancelPaymentResponse;
use Monobank\Acquiring\Response\CreatePaymentByCardCredentialsResponse;
use Monobank\Acquiring\Response\CreateSyncPaymentResponse;
use Monobank\Acquiring\Response\CreateTokenPaymentResponse;
use Monobank\Acquiring\Response\FinalizeHoldResponse;
use Monobank\Acquiring\Response\GetCardsResponse;
use Monobank\Acquiring\Response\GetEmployeeListResponse;
use Monobank\Acquiring\Response\GetFiscalReceiptsResponse;
use Monobank\Acquiring\Response\GetInvoiceStatusResponse;
use Monobank\Acquiring\Response\GetMerchantDataResponse;
use Monobank\Acquiring\Response\GetPublicKeyResponse;
use Monobank\Acquiring\Response\GetQrTerminalInfoResponse;
use Monobank\Acquiring\Response\GetQrTerminalListResponse;
use Monobank\Acquiring\Response\GetReceiptResponse;
use Monobank\Acquiring\Response\GetSplitPaymentRecipientListResponse;
use Monobank\Acquiring\Response\GetStatementByPeriodResponse;
use Monobank\Acquiring\Response\SubMerchantListResponse;
use Monobank\Acquiring\ValueObject\APIToken;
use Monobank\Acquiring\ValueObject\BaseUrl;
use Monobank\Acquiring\ValueObject\Cms;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface as PsrHttpClientClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\RequestInterface;

/**
 * @see https://api.monobank.ua/docs/acquiring.html
 */
final class Client implements ClientInterface
{
    public function __construct(
        private readonly PsrHttpClientClientInterface $client,
        private readonly RequestFactoryInterface $requestFactory,
        private readonly StreamFactoryInterface $streamFactory,
        private readonly APIToken $apiToken,
        private readonly Cms $cms,
        private readonly BaseUrl $baseUrl = new BaseUrl(),
    ) {
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function createInvoice(CreateInvoiceRequest $request): CreateInvoiceResponse
    {
        $httpResponse = $this->client->sendRequest(
            $this->createRequest('POST', '/api/merchant/invoice/create', $request->getPayload())
        );

        self::checkErrors($httpResponse);

        return new CreateInvoiceResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function invalidateInvoice(InvalidateInvoiceRequest $request): void
    {
        $httpRequest = $this->createRequest('POST', '/api/merchant/invoice/remove', $request->getPayload());

        self::checkErrors($this->client->sendRequest($httpRequest));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function cancelPayment(CancelPaymentRequest $request): CancelPaymentResponse
    {
        $httpResponse = $this->client->sendRequest(
            $this->createRequest('POST', '/api/merchant/invoice/cancel', $request->getPayload()),
        );

        self::checkErrors($httpResponse);

        return new CancelPaymentResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function removeTokenizedCard(RemoveTokenizedCardRequest $request): void
    {
        self::checkErrors(
            $this->client->sendRequest(
                $this->createRequest(
                    'DELETE',
                    '/api/merchant/wallet/card',
                    queryParameters: $request->getPayload()
                ),
            ),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function getMerchantData(): GetMerchantDataResponse
    {
        $httpResponse = $this->client->sendRequest($this->createRequest('GET', '/api/merchant/details'));

        self::checkErrors($httpResponse);

        return new GetMerchantDataResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function getReceipt(GetReceiptRequest $request): GetReceiptResponse
    {
        $httpResponse = $this->client->sendRequest($this->createRequest(
            'GET',
            '/api/merchant/invoice/receipt',
            queryParameters: $request->getPayload(),
        ));

        self::checkErrors($httpResponse);

        return new GetReceiptResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function getPublicKey(): GetPublicKeyResponse
    {
        $httpResponse = $this->client->sendRequest($this->createRequest('GET', '/api/merchant/pubkey'));

        self::checkErrors($httpResponse);

        return new GetPublicKeyResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function getEmployeeList(): GetEmployeeListResponse
    {
        $httpResponse = $this->client->sendRequest($this->createRequest('GET', '/api/merchant/employee/list'));

        self::checkErrors($httpResponse);

        return new GetEmployeeListResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function getSubMerchantList(): SubMerchantListResponse
    {
        $httpResponse = $this->client->sendRequest($this->createRequest('GET', '/api/merchant/submerchant/list'));

        self::checkErrors($httpResponse);

        return new SubMerchantListResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function getQrTerminalInfo(GetQrTerminalInfoRequest $request): GetQrTerminalInfoResponse
    {
        $httpResponse = $this->client->sendRequest(
            $this->createRequest('GET', '/api/merchant/qr/details', queryParameters: $request->getPayload())
        );

        self::checkErrors($httpResponse);

        return new GetQrTerminalInfoResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function getQrTerminalList(): GetQrTerminalListResponse
    {
        $httpResponse = $this->client->sendRequest($this->createRequest('GET', '/api/merchant/qr/list'));

        self::checkErrors($httpResponse);

        return new GetQrTerminalListResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function getCards(GetCardsRequest $request): GetCardsResponse
    {
        $httpResponse = $this->client->sendRequest(
            $this->createRequest('GET', '/api/merchant/wallet', queryParameters: $request->getPayload())
        );

        self::checkErrors($httpResponse);

        return new GetCardsResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function removeQrPaymentAmount(RemoveQrPaymentAmountRequest $request): void
    {
        self::checkErrors(
            $this->client->sendRequest(
                $this->createRequest('POST', '/api/merchant/qr/reset-amount', $request->getPayload()),
            ),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function getFiscalReceipts(GetFiscalReceiptsRequest $request): GetFiscalReceiptsResponse
    {
        $httpResponse = $this->client->sendRequest(
            $this->createRequest('GET', '/api/merchant/invoice/fiscal-checks', queryParameters: $request->getPayload())
        );

        self::checkErrors($httpResponse);

        return new GetFiscalReceiptsResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function getInvoiceStatus(GetInvoiceStatusRequest $request): GetInvoiceStatusResponse
    {
        $httpResponse = $this->client->sendRequest(
            $this->createRequest('GET', '/api/merchant/invoice/status', queryParameters: $request->getPayload())
        );

        self::checkErrors($httpResponse);

        return new GetInvoiceStatusResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function finalizeHold(FinalizeHoldRequest $request): FinalizeHoldResponse
    {
        $httpResponse = $this->client->sendRequest(
            $this->createRequest('POST', '/api/merchant/invoice/finalize', payload: $request->getPayload())
        );

        self::checkErrors($httpResponse);

        return new FinalizeHoldResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function getStatementByPeriod(GetStatementByPeriodRequest $request): GetStatementByPeriodResponse
    {
        $httpResponse = $this->client->sendRequest(
            $this->createRequest('GET', '/api/merchant/statement', queryParameters: $request->getPayload())
        );

        self::checkErrors($httpResponse);

        return new GetStatementByPeriodResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function getSplitPaymentRecipientList(): GetSplitPaymentRecipientListResponse
    {
        $httpResponse = $this->client->sendRequest(
            $this->createRequest('GET', '/api/merchant/split-receiver/list')
        );

        self::checkErrors($httpResponse);

        return new GetSplitPaymentRecipientListResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function createTokenPayment(CreateTokenPaymentRequest $request): CreateTokenPaymentResponse
    {
        $httpResponse = $this->client->sendRequest(
            $this->createRequest('POST', '/api/merchant/wallet/payment', payload: $request->getPayload())
        );

        self::checkErrors($httpResponse);

        return new CreateTokenPaymentResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function createPaymentByCardCredentials(
        CreatePaymentByCardCredentialsRequest $request,
    ): CreatePaymentByCardCredentialsResponse {
        $httpResponse = $this->client->sendRequest(
            $this->createRequest('POST', '/api/merchant/invoice/payment-direct', payload: $request->getPayload())
        );

        self::checkErrors($httpResponse);

        return new CreatePaymentByCardCredentialsResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     * @throws MonobankAcquiringException
     */
    public function createSyncPayment(CreateSyncPaymentRequest $request): CreateSyncPaymentResponse
    {
        $httpResponse = $this->client->sendRequest(
            $this->createRequest('POST', '/api/merchant/invoice/sync-payment', payload: $request->getPayload())
        );

        self::checkErrors($httpResponse);

        return new CreateSyncPaymentResponse(
            json_decode($httpResponse->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR),
        );
    }

    private function createRequest(
        string $method,
        string $uri,
        array $payload = [],
        array $queryParameters = [],
    ): RequestInterface {
        $queryString = http_build_query($queryParameters);

        if ($queryString) {
            $uri .= '?' . $queryString;
        }

        $host = rtrim((string)$this->baseUrl, '/');
        $path = '/' . ltrim($uri, '/');
        $url = $host . $path;

        $request = $this->requestFactory->createRequest($method, $url)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept', 'application/json')
            ->withHeader('X-Token', (string)$this->apiToken)
            ->withHeader('X-Cms', $this->cms->getName())
            ->withHeader('X-Cms-Version', $this->cms->getVersion());

        if (!empty($payload)) {
            $request = $request->withBody($this->streamFactory->createStream(json_encode($payload)));
        }

        return $request;
    }

    /**
     * @throws ForbiddenException
     * @throws JsonException
     * @throws NotFoundException
     * @throws TooManyRequestsException
     * @throws InternalServerErrorException
     * @throws UnexpectedException
     * @throws BadRequestException
     */
    private static function checkErrors(ResponseInterface $response): void
    {
        if ($response->getStatusCode() === 200) {
            return;
        }

        $body = $response->getBody()->getContents();
        $errCode = '';
        $errText = '';

        if ($body) {
            $json = json_decode($body, true, flags: JSON_THROW_ON_ERROR);
            $errCode = $json['errCode'] ?? '';
            $errText = $json['errText'] ?? '';
        }

        throw match ($response->getStatusCode()) {
            400 => BadRequestException::create($errCode, $errText),
            403 => ForbiddenException::create($errCode, $errText),
            404 => NotFoundException::create($errCode, $errText),
            429 => TooManyRequestsException::create($errCode, $errText),
            500 => InternalServerErrorException::create($errCode, $errText),
            default => UnexpectedException::create($errCode, $errText),
        };
    }
}
