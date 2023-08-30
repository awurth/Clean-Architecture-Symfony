<?php

declare(strict_types=1);

namespace App\Domain\User\Command;

final class Register
{
    private string $email;
    private string $plainPassword;
    private string $firstname;
    private string $lastname;

    public function __construct(string $email, string $plainPassword, string $firstname, string $lastname)
    {
        $this->email = $email;
        $this->plainPassword = $plainPassword;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
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
