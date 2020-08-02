<?php

namespace App\Infrastructure\Http\Form\DataMapper\User;

use App\Domain\User\Command\Register;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormInterface;
use Traversable;

class RegisterDataMapper implements DataMapperInterface
{
    /**
     * @param Register|null $viewData
     * @param iterable      $forms
     */
    public function mapDataToForms($viewData, iterable $forms): void
    {
        if (null === $viewData) {
            return;
        }

        if (!$viewData instanceof Register) {
            throw new UnexpectedTypeException($viewData, Register::class);
        }

        /** @var FormInterface[]|Traversable $forms */
        $forms = iterator_to_array($forms);

        $forms['email']->setData($viewData->getEmail());
        $forms['plainPassword']->setData($viewData->getPlainPassword());
        $forms['firstname']->setData($viewData->getFirstname());
        $forms['lastname']->setData($viewData->getLastname());
    }

    public function mapFormsToData(iterable $forms, &$viewData): void
    {
        /** @var FormInterface[]|Traversable $forms */
        $forms = iterator_to_array($forms);

        $viewData = new Register(
            $forms['email']->getData(),
            $forms['plainPassword']->getData(),
            $forms['firstname']->getData(),
            $forms['lastname']->getData()
        );
    }
}
