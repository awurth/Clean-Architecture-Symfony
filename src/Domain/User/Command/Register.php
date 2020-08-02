<?php

namespace App\Domain\User\Command;

final class Register
{
    private ?string $email;
    private ?string $plainPassword;
    private ?string $firstname;
    private ?string $lastname;

    public function __construct(?string $email, ?string $plainPassword, ?string $firstname, ?string $lastname)
    {
        $this->email = $email;
        $this->plainPassword = $plainPassword;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }
}
