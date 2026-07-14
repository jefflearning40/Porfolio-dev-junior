<?php

namespace App\Form;

use App\Entity\ContactMessage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

final class ContactType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add('lastName', TextType::class, [
                'label' => 'contact.form.last_name',
            ])

            ->add('firstName', TextType::class, [
                'label' => 'contact.form.first_name',
                'required' => false,
            ])

            ->add('email', EmailType::class, [
                'label' => 'contact.form.email',
            ])

            ->add('subject', TextType::class, [
                'label' => 'contact.form.subject',
            ])

            ->add('message', TextareaType::class, [
                'label' => 'contact.form.message',
                'attr' => [
                    'rows' => 8,
                ],
            ])

            ->add('privacy', CheckboxType::class, [
                'label' => 'contact.form.privacy',
                'mapped' => false,
                'constraints' => [
                    new IsTrue(
                        message: 'contact.form.privacy_error'
                    ),
                ],
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'contact.form.submit',
            ]);
    }

    public function configureOptions(
        OptionsResolver $resolver
    ): void {
        $resolver->setDefaults([
            'data_class' => ContactMessage::class,
            'translation_domain' => 'messages',
        ]);
    }
}