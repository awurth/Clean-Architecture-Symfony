<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use Assert\Assert;

final class Email
{
    private string $email;

    public function __construct(string $email)
    {
        Assert::that($email)->notBlank()->maxLength(255)->email();
        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return $this->email;
    }
}
