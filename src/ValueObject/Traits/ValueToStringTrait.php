<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject\Traits;

/**
 * @property mixed $value
 */
trait ValueToStringTrait
{
    public function __toString(): string
    {
        return (string) $this->value;
    }
}
