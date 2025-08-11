<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request;

use Monobank\Acquiring\Exception\InvalidInvoiceIdException;

class InvalidateInvoiceRequest extends AbstractRequest
{
    /**
     * @throws InvalidInvoiceIdException
     */
    public function __construct(string $invoiceId)
    {
        $invoiceId = trim(strip_tags($invoiceId));

        if (empty($invoiceId)) {
            throw InvalidInvoiceIdException::blankValue();
        }

        $this->setPayloadValue('invoiceId', $invoiceId);
    }
}
