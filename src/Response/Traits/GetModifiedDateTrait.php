<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response\Traits;

use DateTimeImmutable;

/**
 * @method getDateTime(string $key): ?DateTimeImmutable
 */
trait GetModifiedDateTrait
{
    public function getModifiedDate(): ?DateTimeImmutable
    {
        return $this->getDateTime('modifiedDate');
    }
}
