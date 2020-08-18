<?php

namespace App\Application\EventHandler\User;

use App\Domain\User\Event\Registered;

final class RegisteredHandler
{
    private SendRegistrationConfirmationNotificationInterface $sendRegistrationConfirmationNotification;

    public function __construct(SendRegistrationConfirmationNotificationInterface $sendRegistrationConfirmationNotification)
    {
        $this->sendRegistrationConfirmationNotification = $sendRegistrationConfirmationNotification;
    }

    public function __invoke(Registered $registered): void
    {
        $this->sendRegistrationConfirmationNotification->to($registered->userId());
    }
}
