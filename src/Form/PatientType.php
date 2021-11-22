<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, array('label'=>'Nom du Patient : '))
			->add('prenom', TextType::class, array('label'=>'Prénom du Patient : '))
			->add('datenaissance', DateType::class,[
    'widget' => 'single_text',
    'input'  => 'datetime_immutable'
])
			->add('save',SubmitType::class, array('label'=>'Enregistrer le Patient'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'=> Patient::class,
        ]);
    }
}
