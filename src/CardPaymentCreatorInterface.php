<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\CreatePaymentByCardCredentialsRequest;
use Monobank\Acquiring\Response\CreatePaymentByCardCredentialsResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--payment-direct
 */
interface CardPaymentCreatorInterface
{
    public function createPaymentByCardCredentials(
        CreatePaymentByCardCredentialsRequest $request
    ): CreatePaymentByCardCredentialsResponse;
}
