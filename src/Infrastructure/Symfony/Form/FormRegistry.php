<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Form;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

final class FormRegistry
{
    private array $forms = [];

    public function __construct(private readonly FormFactoryInterface $formFactory)
    {
    }

    public function createForm(string $type, mixed $data = null, array $options = []): FormInterface
    {
        $this->forms[$type] = $this->formFactory->create($type, $data, $options);

        return $this->forms[$type];
    }

    public function getForm(string $type): ?FormInterface
    {
        return $this->forms[$type] ?? null;
    }
}
