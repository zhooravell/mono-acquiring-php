<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request;

use Monobank\Acquiring\Exception\InvalidEmailException;
use Monobank\Acquiring\Exception\InvalidInvoiceIdException;

class GetReceiptRequest extends AbstractRequest
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

    /**
     * @throws InvalidEmailException
     */
    public function setEmail(string $email): self
    {
        $email = trim($email);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmailException::invalidEmail($email);
        }

        $this->setPayloadValue('email', $email);

        return $this;
    }
}
