<?php

declare(strict_types=1);

namespace App\Application\CommandHandler\User;

use App\Application\Contract\EventBusInterface;
use App\Domain\User\Command\Register;
use App\Domain\User\Contract\PasswordEncoderInterface;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepositoryInterface;

final class RegisterHandler
{
    private EventBusInterface $eventBus;
    private PasswordEncoderInterface $passwordEncoder;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        EventBusInterface $eventBus,
        PasswordEncoderInterface $passwordEncoder,
        UserRepositoryInterface $userRepository,
    ) {
        $this->eventBus = $eventBus;
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
    }

    public function __invoke(Register $register): void
    {
        $user = User::register($register, $this->passwordEncoder);

        $this->userRepository->add($user);

        $this->eventBus->dispatchAll($user->popEvents());
    }
}
