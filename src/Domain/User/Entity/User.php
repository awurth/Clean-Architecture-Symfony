<?php

namespace App\Domain\User\Entity;

use App\Domain\User\Contract\PasswordEncoderInterface;
use App\Domain\User\Message\Register;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Name;
use App\Domain\Uuid;
use DateTimeImmutable;
use DateTimeInterface;

class User
{
    private string $id;

    private Email $email;

    private Name $name;

    private string $password;

    private DateTimeInterface $createdAt;

    private function __construct(Email $email, Name $name)
    {
        $this->id = Uuid::uuid4();
        $this->email = $email;
        $this->name = $name;
        $this->createdAt = new DateTimeImmutable();
    }

    public static function createFromRegistrationMessage(Register $register, PasswordEncoderInterface $passwordEncoder): self
    {
        $user = new self(
            new Email($register->getEmail()),
            new Name($register->getFirstname(), $register->getLastname())
        );

        $user->password = $passwordEncoder->encodePassword($user, $register->getPlainPassword());

        return $user;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }
}
