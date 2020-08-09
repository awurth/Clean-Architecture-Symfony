<?php

namespace App\Application\Contract;

interface EventBusInterface
{
    public function dispatch(object $event): void;
}
