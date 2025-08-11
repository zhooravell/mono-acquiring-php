<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Exception;

use Exception;

class InvalidEmployeeIdException extends Exception implements MonobankAcquiringException
{
    public static function blankValue(): self
    {
        return new self('Employee ID should not be blank.', self::INVALID_EMPLOYEE_ID_CODE);
    }
}
