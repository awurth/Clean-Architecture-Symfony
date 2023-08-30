<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Security;

use App\Domain\User\Entity\User as DomainUser;
use App\Infrastructure\Persistence\Doctrine\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class UserProvider implements UserProviderInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loadUserByUsername(string $username): UserInterface
    {
        /** @var DomainUser|null $user */
        $user = $this->userRepository->findOneBy(['email' => $username]);

        if (!$user) {
            throw new UsernameNotFoundException();
        }

        return new User($user);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass(string $class): bool
    {
        return User::class === $class;
    }
}
