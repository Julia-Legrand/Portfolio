<?php

namespace App\Form;

use App\Entity\Contact;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contactName', TextType::class, [
                'label' => 'Nom et Prénom',
                'attr' => ['class' => 'custom-form'],
            ])
            ->add('contactEmail', EmailType::class, [
                'label' => 'E-mail',
                'attr' => ['class' => 'custom-form'],
                'constraints' => [
                    new NotBlank(),
                    new Email(),
                ],
            ])
            ->add('contactMessage', TextareaType::class, [
                'label' => 'Message',
                'attr' => ['class' => 'custom-form'],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'J\'accepte le traitement de mes données personnelles dans le cadre de cette prise de contact.',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter le traitement de vos données personnelles.',
                    ]),
                ],
            ])
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'contact',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
