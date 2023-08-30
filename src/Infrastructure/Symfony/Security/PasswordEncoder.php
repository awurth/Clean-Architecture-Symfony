<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Security;

use App\Domain\User\Contract\PasswordEncoderInterface;
use App\Domain\User\Entity\User as DomainUser;

final readonly class PasswordEncoder implements PasswordEncoderInterface
{
    public function __construct(private \Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface $userPasswordEncoder)
    {
    }

    public function encodePassword(DomainUser $user, string $plainPassword): string
    {
        return $this->userPasswordEncoder->encodePassword(new User($user), $plainPassword);
    }
}
