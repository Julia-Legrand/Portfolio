<?php

namespace App\Form;

use App\Entity\Skills;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SkillsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('skillPicture', FileType::class, [
                'label' => 'Illustration',
                'mapped' => false,
                'required' => false,'constraints' => [
                    new File ([
                        'maxSize' => '2000k',
                        'mimeTypes' => ['image/*',],
                        'mimeTypesMessage' => 'Image ne répondant pas aux contraintes.',
                        ])
                ],
            ])
            ->add('skillTitle', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('skillText', TextType::class, [
                'label' => 'Texte'
            ])
            ->add('skillList', TextType::class, [
                'label' => 'Langages et outils'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Skills::class,
        ]);
    }
}
