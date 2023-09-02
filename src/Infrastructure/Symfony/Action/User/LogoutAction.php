<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Action\User;

use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/logout', name: 'app_logout')]
final class LogoutAction
{
    public function __invoke(): void
    {
    }
}
