<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

class SplitReceiver
{
    public function __construct(
        private readonly ?string $id,
        private readonly ?string $name,
    ) {
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
