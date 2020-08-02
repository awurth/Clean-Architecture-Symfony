<?php

namespace App\Application\EventHandler\User;

interface SendRegistrationConfirmationNotificationInterface
{
    public function to(string $userId): void;
}
