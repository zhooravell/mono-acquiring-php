<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\CreateTokenPaymentRequest;
use Monobank\Acquiring\Response\CreateTokenPaymentResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/tokenizatsiia/post--api--merchant--wallet--payment
 */
interface CardTokenPaymentInterface
{
    public function createTokenPayment(CreateTokenPaymentRequest $request): CreateTokenPaymentResponse;
}
