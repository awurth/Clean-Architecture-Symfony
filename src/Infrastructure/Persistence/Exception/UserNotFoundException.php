<?php

namespace App\Infrastructure\Persistence\Exception;

use App\Domain\User\ValueObject\UserId;

final class UserNotFoundException extends EntityNotFoundException
{
    public static function byId(UserId $id): self
    {
        return new self(sprintf('User not found with id "%s"', $id->toString()));
    }
}
