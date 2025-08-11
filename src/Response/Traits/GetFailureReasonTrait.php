<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response\Traits;

/**
 * @method getString(string $key): ?string
 */
trait GetFailureReasonTrait
{
    public function getFailureReason(): ?string
    {
        return $this->getString('failureReason');
    }
}
