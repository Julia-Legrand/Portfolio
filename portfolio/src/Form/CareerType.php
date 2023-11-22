<?php

namespace App\Form;

use App\Entity\Career;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CareerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $years = range(date('Y') - 20, date('Y') + 1);
        $builder
            ->add('careerTitle', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('careerCompany', TextType::class, [
                'label' => 'Entreprise ou École'
            ])
            ->add('careerCity', TextType::class, [
                'label' => 'Ville'
            ])
            ->add('startDate', ChoiceType::class, [
                'choices' => array_combine($years, $years),
                'label' => 'Année de début',
            ])
            ->add('endDate', ChoiceType::class, [
                'choices' => array_combine($years, $years),
                'label' => 'Année de fin',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Career::class,
        ]);
    }
}
