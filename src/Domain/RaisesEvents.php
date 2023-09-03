<?php

declare(strict_types=1);

namespace App\Domain;

trait RaisesEvents
{
    /**
     * @var object[]
     */
    protected array $events = [];

    /**
     * @return object[]
     */
    final public function popEvents(): array
    {
        $events = $this->events;

        $this->events = [];

        return $events;
    }

    protected function raise(object $event): void
    {
        $this->events[] = $event;
    }
}
