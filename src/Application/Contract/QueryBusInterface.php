<?php

namespace App\Application\Contract;

interface QueryBusInterface
{
    /**
     * @param object $query
     * @return mixed
     */
    public function query(object $query);
}
