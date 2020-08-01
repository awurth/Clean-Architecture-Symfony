<?php

namespace App\Application\Adapter;

use App\Domain\User\Contract\PasswordEncoderInterface;
use App\Domain\User\Entity\User;
use App\Infrastructure\Symfony\Security\User as SymfonySecurityUser;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordEncoder implements PasswordEncoderInterface
{
    private UserPasswordEncoderInterface $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function encodePassword(User $user, string $plainPassword): string
    {
        return $this->userPasswordEncoder->encodePassword(new SymfonySecurityUser($user), $plainPassword);
    }
}
