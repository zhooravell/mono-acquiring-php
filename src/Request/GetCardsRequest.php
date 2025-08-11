<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request;

use Monobank\Acquiring\Exception\InvalidWalletIdException;

class GetCardsRequest extends AbstractRequest
{
    /**
     * @throws InvalidWalletIdException
     */
    public function __construct(string $invoiceId)
    {
        $invoiceId = trim(strip_tags($invoiceId));

        if (empty($invoiceId)) {
            throw InvalidWalletIdException::blankValue();
        }

        $this->setPayloadValue('walletId', $invoiceId);
    }
}
