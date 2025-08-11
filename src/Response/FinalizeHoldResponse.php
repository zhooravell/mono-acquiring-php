<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

use Monobank\Acquiring\Enum\FinalizeStatus;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--finalize
 */
class FinalizeHoldResponse extends AbstractResponse
{
    public function getStatus(): FinalizeStatus
    {
        $key = 'status';

        return array_key_exists($key, $this->data)
            ? FinalizeStatus::tryFrom($this->data[$key]) ?: FinalizeStatus::UNKNOWN
            : FinalizeStatus::UNKNOWN;
    }
}
