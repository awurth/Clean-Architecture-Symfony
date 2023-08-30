<?php

declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\UserId;

interface UserRepositoryInterface
{
    public function add(User $user): void;

    public function get(UserId $id): User;
}
