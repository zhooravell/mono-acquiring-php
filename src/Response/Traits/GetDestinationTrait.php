<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response\Traits;

/**
 * @method getString(string $key): ?string
 */
trait GetDestinationTrait
{
    public function getDestination(): ?string
    {
        return $this->getString('destination');
    }
}
