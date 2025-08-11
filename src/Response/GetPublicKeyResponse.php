<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/get--api--merchant--pubkey
 */
class GetPublicKeyResponse extends AbstractResponse
{
    public function getKey(): ?string
    {
        return $this->getString('key');
    }
}
