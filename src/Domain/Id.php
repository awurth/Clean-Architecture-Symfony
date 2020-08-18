<?php

namespace App\Domain;

use Assert\Assertion;

abstract class Id
{
    private string $id;

    final private function __construct(string $id)
    {
        Assertion::uuid($id);
        $this->id = $id;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public static function fromString(string $id): self
    {
        return new static($id);
    }

    public static function generate(): self
    {
        return new static(uuid_create(UUID_TYPE_RANDOM));
    }

    public function equals(Id $id): bool
    {
        return $id->toString() === $this->id;
    }

    public function toString(): string
    {
        return $this->id;
    }
}
