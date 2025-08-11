<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response\Traits;

/**
 * @method getInt(string $key): ?int
 */
trait GetAmountTrait
{
    public function getAmount(): ?int
    {
        return $this->getInt('amount');
    }
}
