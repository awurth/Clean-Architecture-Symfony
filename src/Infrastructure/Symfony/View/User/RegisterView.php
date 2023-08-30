<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\View\User;

use App\Infrastructure\Symfony\Form\FormRegistry;
use App\Infrastructure\Symfony\Form\Type\User\RegisterType;
use App\Presentation\Web\User\Register\RegisterWebViewModel;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final readonly class RegisterView
{
    public function __construct(private Environment $twig, private FormRegistry $formRegistry)
    {
    }

    public function generate(RegisterWebViewModel $viewModel): Response
    {
        if ($viewModel->registered) {
            return new RedirectResponse('/');
        }

        $form = $this->formRegistry->getForm(RegisterType::class);

        return new Response($this->twig->render('app/actions/user/register.html.twig', [
            'form' => $form->createView(),
            'view' => $viewModel,
        ]));
    }
}
