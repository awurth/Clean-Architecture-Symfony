<?php

declare(strict_types=1);

namespace App\Application\EventHandler\User;

use App\Domain\User\ValueObject\UserId;

interface SendRegistrationConfirmationNotificationInterface
{
    public function to(UserId $userId): void;
}
