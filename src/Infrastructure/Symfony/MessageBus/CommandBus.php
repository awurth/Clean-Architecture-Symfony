<?php

namespace App\Infrastructure\Symfony\MessageBus;

use App\Application\Contract\CommandBusInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class CommandBus implements CommandBusInterface
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function execute(object $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
