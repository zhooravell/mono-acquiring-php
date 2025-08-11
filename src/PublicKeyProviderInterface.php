<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Response\GetPublicKeyResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/get--api--merchant--pubkey
 * @see https://monobank.ua/api-docs/acquiring/instrumenty-rozrobky/webhooks/get--api--merchant--pubkey
 */
interface PublicKeyProviderInterface
{
    public function getPublicKey(): GetPublicKeyResponse;
}
