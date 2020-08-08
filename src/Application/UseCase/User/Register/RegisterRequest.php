<?php

namespace App\Application\UseCase\User\Register;

final class RegisterRequest
{
    public $email;
    public $plainPassword;
    public $firstname;
    public $lastname;
}
