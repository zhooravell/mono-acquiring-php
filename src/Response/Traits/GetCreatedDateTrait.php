<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response\Traits;

use DateTimeImmutable;

/**
 * @method getDateTime(string $key): ?DateTimeImmutable
 */
trait GetCreatedDateTrait
{
    public function getCreatedDate(): ?DateTimeImmutable
    {
        return $this->getDateTime('createdDate');
    }
}
