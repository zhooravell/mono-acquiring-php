<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;
use Monobank\Acquiring\Exception\Traits\ErrorCodeTrait;

class ForbiddenException extends Exception implements MonobankAcquiringException
{
    use ErrorCodeTrait;

    public static function create(string $errCode, string $errText): self
    {
        $exception = new self($errText, self::FORBIDDEN_CODE);
        $exception->errCode = $errCode;

        return $exception;
    }
}
