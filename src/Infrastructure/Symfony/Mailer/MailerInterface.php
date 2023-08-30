<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Mailer;

interface MailerInterface
{
    public function createMail(): EmailInterface;

    public function send(EmailInterface $email): void;
}
