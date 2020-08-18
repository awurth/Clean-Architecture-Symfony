<?php

namespace App\Domain;

use DateTimeImmutable;
use DateTimeInterface;

final class Time
{
    public static function now(): DateTimeInterface
    {
        return new DateTimeImmutable();
    }
}
