<?php

declare(strict_types=1);

namespace App\Application\CommandHandler\User;

use App\Application\Contract\EventBusInterface;
use App\Domain\User\Command\Register;
use App\Domain\User\Contract\PasswordEncoderInterface;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepositoryInterface;

final readonly class RegisterHandler
{
    public function __construct(private EventBusInterface $eventBus, private PasswordEncoderInterface $passwordEncoder, private UserRepositoryInterface $userRepository)
    {
    }

    public function __invoke(Register $register): void
    {
        $user = User::register($register, $this->passwordEncoder);

        $this->userRepository->add($user);

        $this->eventBus->dispatchAll($user->popEvents());
    }
}
