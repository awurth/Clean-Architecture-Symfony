<?php

namespace App\Presentation\Web\User\Register;

use App\Application\UseCase\User\Register\RegisterPresenterInterface;
use App\Application\UseCase\User\Register\RegisterResponse;

final class RegisterWebPresenter implements RegisterPresenterInterface
{
    public function present(RegisterResponse $response): RegisterWebViewModel
    {
        $viewModel = new RegisterWebViewModel();
        $viewModel->registered = $response->registered;

        return $viewModel;
    }
}
