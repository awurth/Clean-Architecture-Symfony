<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Mailer;

use Symfony\Component\Mailer\MailerInterface as SymfonyMailerInterface;
use Symfony\Component\Mime\RawMessage;

final class Mailer implements MailerInterface
{
    private SymfonyMailerInterface $mailer;

    public function __construct(SymfonyMailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function createMail(): EmailInterface
    {
        return new Email();
    }

    public function send(EmailInterface $email): void
    {
        $symfonyEmail = $email->getEmail();

        if (!$symfonyEmail instanceof RawMessage) {
            throw new \LogicException(\sprintf('Mailer expects an instance of "%s", "%s" given', RawMessage::class, $symfonyEmail::class));
        }

        $this->mailer->send($symfonyEmail);
    }
}
