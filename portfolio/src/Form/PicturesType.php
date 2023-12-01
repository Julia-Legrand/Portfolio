<?php

namespace App\Form;

use App\Entity\Pictures;
use App\Entity\Projects;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PicturesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('picture', FileType::class, [
                'label' => 'Image :',
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
            ->add('namePicture', TextType::class, [
                'label' => 'Nom de l\'image :',
                'attr' => ['class' => 'custom-form'],
            ])
            ->add('projects', EntityType::class, [
                'class' => Projects::class,
                'label' => 'Projet :',
                'choice_label' => 'projectTitle',
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pictures::class,
        ]);
    }
}
