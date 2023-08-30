<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\MessageBus;

use App\Application\Contract\EventBusInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class EventBus implements EventBusInterface
{
    private MessageBusInterface $eventBus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function dispatch(object $event): void
    {
        $this->eventBus->dispatch($event, [
            new DispatchAfterCurrentBusStamp(),
        ]);
    }

    public function dispatchAll(array $events): void
    {
        foreach ($events as $event) {
            $this->dispatch($event);
        }
    }
}
