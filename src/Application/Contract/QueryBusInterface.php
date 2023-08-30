<?php

declare(strict_types=1);

namespace App\Application\Contract;

interface QueryBusInterface
{
    public function query(object $query);
}
