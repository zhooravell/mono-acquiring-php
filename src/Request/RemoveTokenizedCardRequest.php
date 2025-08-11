<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request;

use Monobank\Acquiring\Exception\InvalidCardTokenException;

class RemoveTokenizedCardRequest extends AbstractRequest
{
    /**
     * @throws InvalidCardTokenException
     */
    public function __construct(string $cardToken)
    {
        $invoiceId = trim(strip_tags($cardToken));

        if (empty($invoiceId)) {
            throw InvalidCardTokenException::blankValue();
        }

        $this->setPayloadValue('cardToken', $cardToken);
    }
}
