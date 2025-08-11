<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

use Monobank\Acquiring\Enum\CancellationStatus;
use Monobank\Acquiring\Response\Traits\GetCreatedDateTrait;
use Monobank\Acquiring\Response\Traits\GetModifiedDateTrait;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/post--api--merchant--invoice--cancel
 */
class CancelPaymentResponse extends AbstractResponse
{
    use GetCreatedDateTrait;
    use GetModifiedDateTrait;

    /**
     * Cancellation Operation Status:
     *
     *  processing - the cancellation request is being processed
     *  success - the cancellation request was completed successfully
     *  failure - unsuccessful cancellation
     */
    public function getStatus(): CancellationStatus
    {
        return array_key_exists('status', $this->data)
            ? CancellationStatus::tryFrom((string)$this->data['status']) ?: CancellationStatus::UNKNOWN
            : CancellationStatus::UNKNOWN;
    }
}
