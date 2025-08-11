<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

use Monobank\Acquiring\Exception\InvalidAPITokenException;
use Monobank\Acquiring\ValueObject\Traits\ValueToStringTrait;
use Stringable;

/**
 * Value object for X-Token
 *
 * @see https://api.monobank.ua/docs/acquiring.html
 */
final class APIToken implements Stringable
{
    use ValueToStringTrait;

    private readonly string $value;

    /**
     * @throws InvalidAPITokenException
     */
    public function __construct(string $value)
    {
        $value = trim($value);

        if (empty($value)) {
            throw InvalidAPITokenException::blankValue();
        }

        $this->value = $value;
    }
}
