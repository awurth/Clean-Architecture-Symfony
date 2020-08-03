<?php

namespace App\Infrastructure\Http\Form\Type\User;

use App\Infrastructure\Http\Form\DataMapper\User\RegisterDataMapper;
use Rollerworks\Component\PasswordStrength\Validator\Constraints\PasswordStrength;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255]),
                    new Email()
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => [
                    new NotBlank(),
                    new PasswordStrength(3)
                ]
            ])
            ->add('firstname', null, [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255])
                ]
            ])
            ->add('lastname', null, [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255])
                ]
            ]);

        $builder->setDataMapper(new RegisterDataMapper());
    }
}
