<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;

use App\Domain\RaisesEvents;
use App\Domain\Time;
use App\Domain\User\Command\Register;
use App\Domain\User\Contract\PasswordEncoderInterface;
use App\Domain\User\Event\Registered;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Name;
use App\Domain\User\ValueObject\UserId;

class User
{
    use RaisesEvents;

    private UserId $id;
    private Email $email;
    private Name $name;
    private string $password;
    private \DateTimeInterface $registeredAt;

    private function __construct(Email $email, Name $name)
    {
        $this->id = UserId::generate();
        $this->email = $email;
        $this->name = $name;
        $this->registeredAt = Time::now();

        $this->raise(new Registered($this->id));
    }

    public static function register(Register $register, PasswordEncoderInterface $passwordEncoder): self
    {
        $user = new self(
            new Email($register->email()),
            new Name($register->firstname(), $register->lastname()),
        );

        $user->password = $passwordEncoder->encodePassword($user, $register->plainPassword());

        return $user;
    }

    public function id(): UserId
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

    public function registeredAt(): \DateTimeInterface
    {
        return $this->registeredAt;
    }
}
