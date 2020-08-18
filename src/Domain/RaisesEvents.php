<?php

namespace App\Domain;

trait RaisesEvents
{
    protected array $events = [];

    protected function raise(object $event): void
    {
        $this->events[] = $event;
    }

    final public function popEvents(): array
    {
        $events = $this->events;

        $this->events = [];

        return $events;
    }
}
