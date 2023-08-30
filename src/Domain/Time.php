<?php

declare(strict_types=1);

namespace App\Domain;

final class Time
{
    public static function now(): \DateTimeInterface
    {
        return new \DateTimeImmutable();
    }
}
