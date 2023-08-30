<?php

declare(strict_types=1);

namespace App\Domain\User\Command;

final readonly class Register
{
    public function __construct(private string $email, private string $plainPassword, private string $firstname, private string $lastname)
    {
    }

    public function email(): string
    {
        return $this->email;
    }

    public function plainPassword(): string
    {
        return $this->plainPassword;
    }

    public function firstname(): string
    {
        return $this->firstname;
    }

    public function lastname(): string
    {
        return $this->lastname;
    }
}
