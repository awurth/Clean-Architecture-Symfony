<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Action\User;

use App\Application\UseCase\User\Register\RegisterUseCase;
use App\Infrastructure\Symfony\Form\FormRegistry;
use App\Infrastructure\Symfony\Form\Type\User\RegisterType;
use App\Infrastructure\Symfony\View\User\RegisterView;
use App\Presentation\Web\User\Register\RegisterWebPresenter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/register', name: 'app_register', methods: ['GET', 'POST'])]
final readonly class RegisterAction
{
    public function __construct(private FormRegistry $formRegistry, private RegisterWebPresenter $registerPresenter, private RegisterUseCase $registerUseCase, private RegisterView $registerView)
    {
    }

    public function __invoke(Request $request): Response
    {
        $form = $this->formRegistry->createForm(RegisterType::class);
        $form->handleRequest($request);

        $registerRequest = $form->getData();

        $registerResponse = $this->registerUseCase->execute($registerRequest);
        $viewModel = $this->registerPresenter->present($registerResponse);

        return $this->registerView->generate($viewModel);
    }
}
