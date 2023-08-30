<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\MessageBus;

use App\Application\Contract\CommandBusInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class CommandBus implements CommandBusInterface
{
    public function __construct(private MessageBusInterface $commandBus)
    {
    }

    public function execute(object $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
