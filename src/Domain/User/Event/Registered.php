<?php

declare(strict_types=1);

namespace App\Domain\User\Event;

use App\Domain\User\ValueObject\UserId;

final readonly class Registered
{
    public function __construct(private UserId $userId)
    {
    }

    public function userId(): UserId
    {
        return $this->userId;
    }
}
