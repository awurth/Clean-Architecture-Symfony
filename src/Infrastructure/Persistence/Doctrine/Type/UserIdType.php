<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\Domain\User\ValueObject\UserId;

final class UserIdType extends UuidType
{
    protected function getClass(): string
    {
        return UserId::class;
    }

    protected function getTypeName(): string
    {
        return 'user_id';
    }
}
