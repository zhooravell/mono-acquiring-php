<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\CancelPaymentRequest;
use Monobank\Acquiring\Request\CreatePaymentByCardCredentialsRequest;
use Monobank\Acquiring\Request\CreateSyncPaymentRequest;
use Monobank\Acquiring\Request\CreateTokenPaymentRequest;
use Monobank\Acquiring\Response\CancelPaymentResponse;
use Monobank\Acquiring\Response\CreatePaymentByCardCredentialsResponse;
use Monobank\Acquiring\Response\CreateSyncPaymentResponse;
use Monobank\Acquiring\Response\CreateTokenPaymentResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--payment-direct
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--cancel
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/post--api--merchant--invoice--cancel
 * @see https://monobank.ua/api-docs/acquiring/metody/oplata-v-zastosunku/post--api--merchant--invoice--cancel
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/post--api--merchant--invoice--cancel
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/tokenizatsiia/post--api--merchant--wallet--payment
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--sync-payment
 */
interface PaymentManagementInterface
{
    public function createPaymentByCardCredentials(
        CreatePaymentByCardCredentialsRequest $request
    ): CreatePaymentByCardCredentialsResponse;

    public function cancelPayment(CancelPaymentRequest $request): CancelPaymentResponse;
    public function createTokenPayment(CreateTokenPaymentRequest $request): CreateTokenPaymentResponse;
    public function createSyncPayment(CreateSyncPaymentRequest $request): CreateSyncPaymentResponse;
}
