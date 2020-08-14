<?php

namespace App\Domain;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;

final class Time
{
    public static function now(): DateTimeInterface
    {
        return new DateTime();
    }

    public static function nowImmutable(): DateTimeInterface
    {
        return new DateTimeImmutable();
    }
}
