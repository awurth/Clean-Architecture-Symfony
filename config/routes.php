<?php

use App\Infrastructure\Symfony\Action\User\LogoutAction;
use App\Infrastructure\Symfony\Action\User\RegisterAction;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routes) {
    $routes->add('app_logout', '/logout')
        ->controller(LogoutAction::class);

    $routes->add('app_register', '/register')
        ->controller(RegisterAction::class)
        ->methods(['GET', 'POST']);
};
