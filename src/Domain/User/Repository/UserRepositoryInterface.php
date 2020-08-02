<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Entity\User;

interface UserRepositoryInterface
{
    public function add(User $user): void;

    public function get(string $id): User;
}
