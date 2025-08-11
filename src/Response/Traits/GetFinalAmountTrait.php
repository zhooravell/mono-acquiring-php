<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response\Traits;

/**
 * @method getInt(string $key): ?int
 */
trait GetFinalAmountTrait
{
    public function getFinalAmount(): ?int
    {
        return $this->getInt('finalAmount');
    }
}
