<?php

namespace App\Form;

use App\Entity\Presentation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PresentationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('wallpaper',FileType::class, [
                'label' => 'Fond d\'écran',
                'attr' => ['class' => 'custom-form'],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2000k',
                        'mimeTypes' => ['image/*',],
                        'mimeTypesMessage' => 'Image ne répondant pas aux contraintes.',
                    ])
                ]
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => ['class' => 'custom-form'],
            ])
            ->add('cv', FileType::class, [
                'label' => 'CV',
                'attr' => ['class' => 'custom-form'],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2000k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Document ne répondant pas aux contraintes.',
                    ])
                ]
            ])
            ->add('githubLink', TextType::class, [
                'label' => 'Lien Github',
                'attr' => ['class' => 'custom-form'],
            ])
            ->add('linkedinLink', TextType::class, [
                'label' => 'Lien LinkedIn',
                'attr' => ['class' => 'custom-form'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Presentation::class,
        ]);
    }
}
