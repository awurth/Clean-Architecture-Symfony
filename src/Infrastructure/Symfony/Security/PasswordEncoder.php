<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Security;

use App\Domain\User\Contract\PasswordEncoderInterface;
use App\Domain\User\Entity\User as DomainUser;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class PasswordEncoder implements PasswordEncoderInterface
{
    private UserPasswordEncoderInterface $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function encodePassword(DomainUser $user, string $plainPassword): string
    {
        return $this->userPasswordEncoder->encodePassword(new User($user), $plainPassword);
    }
}
