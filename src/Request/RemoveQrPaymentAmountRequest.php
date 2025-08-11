<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request;

use Monobank\Acquiring\Exception\InvalidQRIdException;

class RemoveQrPaymentAmountRequest extends AbstractRequest
{
    /**
     * @throws InvalidQRIdException
     */
    public function __construct(string $qrId)
    {
        $qrId = trim(strip_tags($qrId));

        if (empty($qrId)) {
            throw InvalidQRIdException::blankValue();
        }

        $this->setPayloadValue('qrId', $qrId);
    }
}
