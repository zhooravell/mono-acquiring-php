<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response\Traits;

/**
 * @method getString(string $key): ?string
 */
trait GetInvoiceIdTrait
{
    public function getInvoiceId(): ?string
    {
        return $this->getString('invoiceId');
    }
}
