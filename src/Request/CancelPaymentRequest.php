<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request;

use Monobank\Acquiring\Exception\InvalidInvoiceIdException;
use Monobank\Acquiring\ValueObject\BasketItem;

class CancelPaymentRequest extends AbstractRequest
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
     * Seller-defined cancellation reference
     */
    public function setExternalReference(string $extRef): self
    {
        $this->setPayloadValue('extRef', trim(strip_tags($extRef)));

        return $this;
    }

    /**
     * Partial refund amount in minor units
     */
    public function setAmount(int $amount): self
    {
        $this->setPayloadValue('amount', $amount);

        return $this;
    }

    /**
     * List of products for creating a return receipt, a required field if fiscalization is activated.
     */
    public function addBasketItem(BasketItem $item): self
    {
        if (!array_key_exists('items', $this->payload)) {
            $this->payload['items'] = [];
        }

        $this->payload['items'][] = $item->toArray();

        return $this;
    }
}
