<?php

declare(strict_types=1);

namespace App\Infrastructure\Notification\User;

use App\Application\EventHandler\User\SendRegistrationConfirmationNotificationInterface;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\UserId;
use App\Infrastructure\Symfony\Mailer\MailerInterface;

final readonly class SendRegistrationConfirmationEmail implements SendRegistrationConfirmationNotificationInterface
{
    public function __construct(private MailerInterface $mailer, private UserRepositoryInterface $userRepository)
    {
    }

    public function to(UserId $userId): void
    {
        $user = $this->userRepository->get($userId);

        $this->mailer->send(
            $this->mailer->createMail()
                ->to($user->email()->toString())
                ->htmlTemplate('app/emails/user/confirm_registration.html.twig')
                ->context([
                    'user' => $user,
                ]),
        );
    }
}
