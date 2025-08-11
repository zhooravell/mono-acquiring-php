<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

use Monobank\Acquiring\Response\Traits\GetInvoiceIdTrait;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/post--api--merchant--invoice--create
 */
final class CreateInvoiceResponse extends AbstractResponse
{
    use GetInvoiceIdTrait;

    public function getPageUrl(): ?string
    {
        return $this->getString('pageUrl');
    }
}
