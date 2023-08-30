<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\MessageBus;

use App\Application\Contract\QueryBusInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class QueryBus implements QueryBusInterface
{
    private MessageBusInterface $queryBus;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function query(object $query)
    {
        $envelope = $this->queryBus->dispatch($query);

        /** @var HandledStamp $handled */
        $handled = $envelope->last(HandledStamp::class);

        return $handled->getResult();
    }
}
