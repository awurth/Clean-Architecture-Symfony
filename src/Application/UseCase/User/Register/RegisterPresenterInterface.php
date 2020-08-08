<?php

namespace App\Application\UseCase\User\Register;

interface RegisterPresenterInterface
{
    public function present(RegisterResponse $response);
}
