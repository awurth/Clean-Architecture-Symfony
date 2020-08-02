<?php

namespace App\Infrastructure\Symfony\Mailer;

interface EmailInterface
{
    public function context(array $context): self;

    public function from(...$addresses): self;

    public function getEmail();

    public function html(string $body): self;

    public function htmlTemplate(string $template): self;

    public function subject(string $subject): self;

    public function text(string $body): self;

    public function textTemplate(string $template): self;

    public function to(...$addresses): self;
}
