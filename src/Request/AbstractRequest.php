<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request;

abstract class AbstractRequest
{
    protected array $payload = [];

    public function getPayload(): array
    {
        return $this->payload;
    }

    protected function setPayloadValue(string $key, $value): void
    {
        $this->payload[$key] = $value;
    }
}
