<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Application\Contract\CommandBusInterface;
use App\Application\Contract\EventBusInterface;
use App\Application\Contract\QueryBusInterface;
use App\Application\EventHandler\User\SendRegistrationConfirmationNotificationInterface;
use App\Domain\User\Contract\PasswordEncoderInterface;
use App\Infrastructure\Notification\User\SendRegistrationConfirmationEmail;
use App\Infrastructure\Symfony\MessageBus\CommandBus;
use App\Infrastructure\Symfony\MessageBus\EventBus;
use App\Infrastructure\Symfony\MessageBus\QueryBus;
use App\Infrastructure\Symfony\Security\PasswordEncoder;

return static function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
            ->autowire()
            ->autoconfigure();

    $configurator->parameters()
        ->set('app.mailer.default_sender', '%env(MAILER_DEFAULT_SENDER)%');

    $services->load('App\\Infrastructure\\Symfony\\', '../../../src/Infrastructure/Symfony/*')
        ->exclude([
            '../../../src/Infrastructure/Symfony/{DependencyInjection,Kernel.php}',
            '../../../src/Infrastructure/Symfony/Security/User.php'
        ]);

    $services->load('App\\Presentation\\', '../../../src/Presentation/*');

    $services->load('App\\Application\\UseCase\\', '../../../src/Application/UseCase');

    $services->load('App\\Infrastructure\\Persistence\\Doctrine\\Repository\\', '../../../src/Infrastructure/Persistence/Doctrine/Repository')
        ->tag('app.entity_repository');

    $services->load('App\\Infrastructure\\Symfony\\Action\\', '../../../src/Infrastructure/Symfony/Action')
        ->tag('controller.service_arguments');

    $services->load('App\\Application\\CommandHandler\\', '../../../src/Application/CommandHandler')
        ->tag('messenger.message_handler', ['bus' => 'command.bus']);

    $services->load('App\\Application\\QueryHandler\\', '../../../src/Application/QueryHandler')
        ->tag('messenger.message_handler', ['bus' => 'query.bus']);

    $services->load('App\\Application\\EventHandler\\', '../../../src/Application/EventHandler')
        ->tag('messenger.message_handler', ['bus' => 'event.bus']);

    $services->alias(CommandBusInterface::class, CommandBus::class);
    $services->alias(EventBusInterface::class, EventBus::class);
    $services->alias(QueryBusInterface::class, QueryBus::class);

    $services->set(PasswordEncoder::class)
        ->alias(PasswordEncoderInterface::class, PasswordEncoder::class);

    $services->set(SendRegistrationConfirmationEmail::class)
        ->alias(SendRegistrationConfirmationNotificationInterface::class, SendRegistrationConfirmationEmail::class);
};
