<?php

namespace App\Application\Contract;

interface CommandBusInterface
{
    public function execute(object $command): void;
}
