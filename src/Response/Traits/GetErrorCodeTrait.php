<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response\Traits;

/**
 * @method getString(string $key): ?string
 */
trait GetErrorCodeTrait
{
    public function getErrorCode(): ?string
    {
        return $this->getString('errCode');
    }
}
