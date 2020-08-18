<?php

namespace App\Application\Contract;

interface EventBusInterface
{
    public function dispatch(object $event): void;

    public function dispatchAll(array $events): void;
}
