<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;
use Monobank\Acquiring\Exception\Traits\ErrorCodeTrait;

class TooManyRequestsException extends Exception implements MonobankAcquiringException
{
    use ErrorCodeTrait;

    public static function create(string $errCode, string $errText): self
    {
        $exception = new self($errText, self::TOO_MANY_REQUEST_CODE);
        $exception->errCode = $errCode;

        return $exception;
    }
}
