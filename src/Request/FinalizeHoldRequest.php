<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request;

use Monobank\Acquiring\Exception\InvalidInvoiceIdException;
use Monobank\Acquiring\ValueObject\BasketItem;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--finalize
 * @see https://monobank.ua/api-docs/acquiring/metody/oplata-v-zastosunku/post--api--merchant--invoice--finalize
 */
class FinalizeHoldRequest extends AbstractRequest
{
    /**
     * @throws InvalidInvoiceIdException
     */
    public function __construct(string $invoiceId, int $amount)
    {
        $invoiceId = trim(strip_tags($invoiceId));

        if (empty($invoiceId)) {
            throw InvalidInvoiceIdException::blankValue();
        }

        $this->setPayloadValue('invoiceId', $invoiceId);
        $this->setPayloadValue('amount', $amount);
    }

    public function addBasketItem(BasketItem $item): self
    {
        if (!array_key_exists('items', $this->payload)) {
            $this->payload['items'] = [];
        }

        $this->payload['items'][] = $item->toArray();

        return $this;
    }
}
