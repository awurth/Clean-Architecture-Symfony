<?php

declare(strict_types=1);

namespace App\Application\UseCase\User\Register;

use App\Application\Contract\CommandBusInterface;
use App\Domain\User\Command\Register;

final class RegisterUseCase
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function execute(?RegisterRequest $request): RegisterResponse
    {
        $response = new RegisterResponse();

        if ($request) {
            $this->commandBus->execute(new Register(
                $request->email,
                $request->plainPassword,
                $request->firstname,
                $request->lastname,
            ));

            $response->registered = true;
        }

        return $response;
    }
}
