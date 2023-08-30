<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Mailer;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;

final readonly class Email implements EmailInterface
{
    private TemplatedEmail $email;

    public function __construct()
    {
        $this->email = new TemplatedEmail();
    }

    public function context(array $context): self
    {
        $this->email->context($context);

        return $this;
    }

    public function from(...$addresses): self
    {
        $this->email->from(...$addresses);

        return $this;
    }

    public function getEmail(): TemplatedEmail
    {
        return $this->email;
    }

    public function html(string $body): self
    {
        $this->email->html($body);

        return $this;
    }

    public function htmlTemplate(string $template): self
    {
        $this->email->htmlTemplate($template);

        return $this;
    }

    public function subject(string $subject): self
    {
        $this->email->subject($subject);

        return $this;
    }

    public function text(string $body): self
    {
        $this->email->text($body);

        return $this;
    }

    public function textTemplate(string $template): self
    {
        $this->email->textTemplate($template);

        return $this;
    }

    public function to(...$addresses): self
    {
        $this->email->to(...$addresses);

        return $this;
    }
}
