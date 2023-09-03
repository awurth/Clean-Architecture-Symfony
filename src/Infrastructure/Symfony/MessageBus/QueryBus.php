<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\MessageBus;

use App\Application\Contract\QueryBusInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final readonly class QueryBus implements QueryBusInterface
{
    public function __construct(private MessageBusInterface $queryBus)
    {
    }

    public function query(object $query): mixed
    {
        $envelope = $this->queryBus->dispatch($query);

        /** @var HandledStamp $handled */
        $handled = $envelope->last(HandledStamp::class);

        return $handled->getResult();
    }
}
