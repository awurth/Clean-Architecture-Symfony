<?php

namespace App\Domain\User\Contract;

use App\Domain\User\Entity\User;

interface PasswordEncoderInterface
{
    public function encodePassword(User $user, string $plainPassword): string;
}
