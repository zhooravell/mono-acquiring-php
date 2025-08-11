<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

/**
 * @see https://api.monobank.ua/docs/acquiring.html
 */
final class Employee
{
    public function __construct(
        private readonly ?string $id,
        private readonly ?string $name,
        private readonly ?string $extRef,
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

    public function getExtRef(): ?string
    {
        return $this->extRef;
    }
}
