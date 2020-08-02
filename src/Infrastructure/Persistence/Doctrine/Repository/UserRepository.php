<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\Entity\User;
use App\Infrastructure\Persistence\Doctrine\Exception\UserNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function add(User $user): void
    {
        $this->getEntityManager()->persist($user);
    }

    public function get(string $id): User
    {
        $user = $this->find($id);

        if (!$user instanceof User) {
            throw UserNotFoundException::byId($id);
        }

        return $user;
    }
}
