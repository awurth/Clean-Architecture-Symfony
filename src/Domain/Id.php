<?php

declare(strict_types=1);

namespace App\Domain;

use Assert\Assertion;
use Symfony\Component\Uid\Uuid;

abstract readonly class Id implements \Stringable
{
    final private function __construct(private string $id)
    {
        Assertion::uuid($id);
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
        return new static((string)Uuid::v4());
    }

    public function equals(self $id): bool
    {
        return $id->toString() === $this->id;
    }

    public function toString(): string
    {
        return $this->id;
    }
}
