<?php

namespace App\Form;

use App\Entity\Skills;
use App\Entity\Projects;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProjectsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('projectPicture', FileType::class, [
            'label' => 'Illustration',
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
            ->add('projectTitle', TextType::class, [
                'label' => 'Titre du projet',
                'attr' => ['class' => 'custom-form'],
            ])
            ->add('projectText', TextType::class, [
                'label' => 'Présentation',
                'attr' => ['class' => 'custom-form'],
            ])
            ->add('skills', EntityType::class, [
                'class' => Skills::class,
                'label' => 'Compétences :',
                'choice_label' => 'skillTitle',
                'multiple' => true,
                'expanded' => true,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projects::class,
        ]);
    }
}
