<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\MessageBus;

use App\Application\Contract\EventBusInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final readonly class EventBus implements EventBusInterface
{
    public function __construct(private MessageBusInterface $eventBus)
    {
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
