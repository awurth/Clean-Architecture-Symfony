<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Mailer;

use Symfony\Component\Mime\RawMessage;

interface EmailInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function context(array $context): self;

    public function from(string ...$addresses): self;

    public function getEmail(): RawMessage;

    public function html(string $body): self;

    public function htmlTemplate(string $template): self;

    public function subject(string $subject): self;

    public function text(string $body): self;

    public function textTemplate(string $template): self;

    public function to(string ...$addresses): self;
}
