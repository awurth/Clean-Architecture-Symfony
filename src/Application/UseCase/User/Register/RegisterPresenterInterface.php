<?php

declare(strict_types=1);

namespace App\Application\UseCase\User\Register;

interface RegisterPresenterInterface
{
    public function present(RegisterResponse $response);
}
