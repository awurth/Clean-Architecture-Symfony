<?php

namespace App\Infrastructure\Persistence\Doctrine\Exception;

final class UserNotFoundException extends EntityNotFoundException
{
    public static function byId(string $id): self
    {
        return new self(sprintf('User not found with id "%s"', $id));
    }
}
