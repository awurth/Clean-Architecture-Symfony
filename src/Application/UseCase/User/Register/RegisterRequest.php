<?php

declare(strict_types=1);

namespace App\Application\UseCase\User\Register;

final class RegisterRequest
{
    public mixed $email;
    public mixed $plainPassword;
    public mixed $firstname;
    public mixed $lastname;
}
