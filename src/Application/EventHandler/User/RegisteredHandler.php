<?php

declare(strict_types=1);

namespace App\Application\EventHandler\User;

use App\Domain\User\Event\Registered;

final readonly class RegisteredHandler
{
    public function __construct(private SendRegistrationConfirmationNotificationInterface $sendRegistrationConfirmationNotification)
    {
    }

    public function __invoke(Registered $registered): void
    {
        $this->sendRegistrationConfirmationNotification->to($registered->userId());
    }
}
