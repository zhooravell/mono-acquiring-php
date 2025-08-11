<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/get--api--merchant--invoice--receipt
 */
class GetReceiptResponse extends AbstractResponse
{
    public function getFileContent(): ?string
    {
        return $this->getString('file');
    }
}
