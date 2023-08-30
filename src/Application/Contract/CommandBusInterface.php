<?php

declare(strict_types=1);

namespace App\Application\Contract;

interface CommandBusInterface
{
    public function execute(object $command): void;
}
