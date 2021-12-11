<?php

namespace App\Form;

use App\Entity\Sejour;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SejourPreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateArrivee', DateType::class,['widget' => 'single_text','input'  => 'datetime_immutable', 'label'  =>'Date du séjour : '])

            ->add('save',SubmitType::class, array('label'=>'Chercher'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sejour::class,
        ]);
    }
}
