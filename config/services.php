<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Application\Adapter\PasswordEncoder;
use App\Domain\User\Contract\PasswordEncoderInterface;

return static function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
            ->autowire()
            ->autoconfigure();

    $services->load('App\\Infrastructure\\Symfony\\', '../../../src/Infrastructure/Symfony/*')
        ->exclude('../../../src/Infrastructure/Symfony/{DependencyInjection,Kernel.php}');

    $services->load('App\\Infrastructure\\Persistence\\Doctrine\\Repository\\', '../../../src/Infrastructure/Persistence/Doctrine/Repository')
        ->tag('app.entity_repository');

    $services->load('App\\Infrastructure\\Http\\Action\\', '../../../src/Infrastructure/Http/Action')
        ->tag('controller.service_arguments');

    $services->load('App\\Application\\MessageHandler\\', '../../../src/Application/MessageHandler')
        ->tag('messenger.message_handler');

    $services->set(PasswordEncoder::class)
        ->alias(PasswordEncoderInterface::class, PasswordEncoder::class);
};
