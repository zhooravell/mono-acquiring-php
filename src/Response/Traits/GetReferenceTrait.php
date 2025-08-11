<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response\Traits;

/**
 * @method getString(string $key): ?string
 */
trait GetReferenceTrait
{
    public function getReference(): ?string
    {
        return $this->getString('reference');
    }
}
