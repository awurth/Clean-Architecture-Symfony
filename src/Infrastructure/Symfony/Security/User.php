<?php

namespace App\Infrastructure\Symfony\Security;

use App\Domain\User\Entity\User as DomainUser;
use Symfony\Component\Security\Core\User\UserInterface;

final class User implements UserInterface
{
    private DomainUser $user;

    public function __construct(DomainUser $user)
    {
        $this->user = $user;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function getPassword(): string
    {
        return $this->user->password();
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->user->email();
    }

    public function eraseCredentials(): void
    {
    }
}
