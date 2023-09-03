<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Security;

use App\Domain\User\Contract\PasswordEncoderInterface;
use App\Domain\User\Entity\User as DomainUser;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final readonly class PasswordEncoder implements PasswordEncoderInterface
{
    public function __construct(private UserPasswordHasherInterface $userPasswordEncoder)
    {
    }

    public function encodePassword(DomainUser $user, string $plainPassword): string
    {
        return $this->userPasswordEncoder->hashPassword(new User($user), $plainPassword);
    }
}
