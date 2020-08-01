<?php

namespace App\Infrastructure\Http\Action\User;

use App\Infrastructure\Http\Form\Type\User\RegisterType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Twig\Environment;

final class RegisterAction
{
    private Environment $twig;
    private FormFactoryInterface $formFactory;
    private MessageBusInterface $messageBus;

    public function __construct(Environment $twig, FormFactoryInterface $formFactory, MessageBusInterface $messageBus)
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->messageBus = $messageBus;
    }

    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(RegisterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $this->messageBus->dispatch($form->getData());
            return new RedirectResponse('/');
        }

        return new Response($this->twig->render('app/actions/user/register.html.twig', [
            'form' => $form->createView()
        ]));
    }
}
