<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception\Traits;

trait ErrorCodeTrait
{
    private string $errCode;

    public function getErrorCode(): string
    {
        return $this->errCode;
    }
}
