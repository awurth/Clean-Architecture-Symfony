<?php

declare(strict_types=1);

namespace App\Application\UseCase\User\Register;

final class RegisterRequest
{
    public $email;
    public $plainPassword;
    public $firstname;
    public $lastname;
}
