<?php

namespace App\Infrastructure\Symfony\View\User;

use App\Infrastructure\Symfony\Form\FormRegistry;
use App\Infrastructure\Symfony\Form\Type\User\RegisterType;
use App\Presentation\Web\User\Register\RegisterWebViewModel;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class RegisterView
{
    private Environment $twig;
    private FormRegistry $formRegistry;

    public function __construct(Environment $twig, FormRegistry $formRegistry)
    {
        $this->twig = $twig;
        $this->formRegistry = $formRegistry;
    }

    public function generate(RegisterWebViewModel $viewModel): Response
    {
        if ($viewModel->registered) {
            return new RedirectResponse('/');
        }

        $form = $this->formRegistry->getForm(RegisterType::class);

        return new Response($this->twig->render('app/actions/user/register.html.twig', [
            'form' => $form->createView(),
            'view' => $viewModel
        ]));
    }
}
