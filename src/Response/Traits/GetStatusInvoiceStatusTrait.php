<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response\Traits;

use Monobank\Acquiring\Enum\InvoiceStatus;

/**
 * @property array $data
 */
trait GetStatusInvoiceStatusTrait
{
    public function getStatus(): InvoiceStatus
    {
        return array_key_exists('status', $this->data)
            ? InvoiceStatus::tryFrom((string)$this->data['status']) ?: InvoiceStatus::UNKNOWN
            : InvoiceStatus::UNKNOWN;
    }
}
