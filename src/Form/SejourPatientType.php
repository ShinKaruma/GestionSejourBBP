<?php

namespace App\Form;

use App\Entity\Sejour;
use App\Entity\Patient;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SejourPatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numPatient',EntityType::class, array('class'=>Patient::class ,'label'=>'Patient: '))
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
