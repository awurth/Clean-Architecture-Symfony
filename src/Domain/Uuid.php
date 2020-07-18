<?php

namespace App\Domain;

final class Uuid
{
    public static function uuid4(): string
    {
        return uuid_create(UUID_TYPE_RANDOM);
    }

    public static function isValid(string $uuid): bool
    {
        return uuid_is_valid($uuid);
    }
}
