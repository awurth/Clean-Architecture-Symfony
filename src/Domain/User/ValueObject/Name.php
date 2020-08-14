<?php

namespace App\Domain\User\ValueObject;

use Assert\Assert;

final class Name
{
    private string $firstname;

    private string $lastname;

    public function __construct(string $firstname, string $lastname)
    {
        Assert::that($firstname)->notBlank()->maxLength(255);
        Assert::that($lastname)->notBlank()->maxLength(255);

        $this->firstname = $firstname;
        $this->lastname = $lastname;
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
