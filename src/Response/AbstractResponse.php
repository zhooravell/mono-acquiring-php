<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

use DateTimeImmutable;
use Monobank\Acquiring\Enum\Currency;
use Throwable;

abstract class AbstractResponse
{
    public function __construct(
        protected readonly array $data,
    ) {
    }

    protected function getString(string $key): ?string
    {
        return self::stringOrNull($this->data, $key);
    }

    protected function getInt(string $key): ?int
    {
        return self::intOrNull($this->data, $key);
    }

    protected function getDateTime(string $key): ?DateTimeImmutable
    {
        if (($value = $this->getString($key)) !== null) {
            try {
                return new DateTimeImmutable($value);
            } catch (Throwable) {
            }
        }

        return null;
    }

    protected function getArray(string $key): ?array
    {
        return array_key_exists($key, $this->data) && $this->data[$key] !== null ? (array)$this->data[$key] : [];
    }

    protected function getCurrencyEnum(string $key): Currency
    {
        return array_key_exists($key, $this->data)
            ? Currency::tryFrom($this->data[$key]) ?: Currency::UNKNOWN
            : Currency::UNKNOWN;
    }

    protected static function stringOrNull(array $data, string $key): ?string
    {
        return array_key_exists($key, $data) && $data[$key] !== null ? (string)$data[$key] : null;
    }

    protected static function intOrNull(array $data, string $key): ?int
    {
        return array_key_exists($key, $data) && $data[$key] !== null ? (int)$data[$key] : null;
    }
}
