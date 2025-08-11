<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

use Monobank\Acquiring\Exception\InvalidBaseUrlException;
use Monobank\Acquiring\ValueObject\Traits\ValueToStringTrait;
use Stringable;

final class BaseUrl implements Stringable
{
    use ValueToStringTrait;

    private readonly string $value;

    /**
     * @throws InvalidBaseUrlException
     */
    public function __construct(string $value = 'https://api.monobank.ua/')
    {
        $value = trim($value);

        if (empty($value)) {
            throw InvalidBaseUrlException::blankValue();
        }

        $value = filter_var($value, FILTER_SANITIZE_URL);

        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw InvalidBaseUrlException::invalidURL($value);
        }

        $this->value = $value;
    }
}
