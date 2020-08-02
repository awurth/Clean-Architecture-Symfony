<?php

namespace App\Application\CommandHandler\User;

use App\Domain\User\Command\Register;
use App\Domain\User\Contract\PasswordEncoderInterface;
use App\Domain\User\Entity\User;
use App\Domain\User\Event\Registered;
use App\Domain\User\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class RegisterHandler
{
    private MessageBusInterface $eventBus;
    private PasswordEncoderInterface $passwordEncoder;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        MessageBusInterface $eventBus,
        PasswordEncoderInterface $passwordEncoder,
        UserRepositoryInterface $userRepository
    )
    {
        $this->eventBus = $eventBus;
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
    }

    public function __invoke(Register $register): void
    {
        $user = User::createFromRegistrationMessage($register, $this->passwordEncoder);

        $this->userRepository->add($user);

        $this->eventBus->dispatch(new Registered($user->id()), [
            new DispatchAfterCurrentBusStamp()
        ]);
    }
}
