<?php

namespace App\Application\UseCase\User\Register;

use App\Domain\User\Command\Register;
use Symfony\Component\Messenger\MessageBusInterface;

final class RegisterUseCase
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function execute(?RegisterRequest $request): RegisterResponse
    {
        $response = new RegisterResponse();

        if ($request) {
            $this->commandBus->dispatch(new Register(
                $request->email,
                $request->plainPassword,
                $request->firstname,
                $request->lastname
            ));

            $response->registered = true;
        }

        return $response;
    }
}
