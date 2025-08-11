<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response\Traits;

/**
 * @method getString(string $key): ?string
 */
trait GetTdsUrlTrait
{
    public function getTdsUrl(): ?string
    {
        return $this->getString('tdsUrl');
    }
}
