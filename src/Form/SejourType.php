<?php

namespace App\Form;

use App\Entity\Sejour;
use App\Entity\Chambre;
use App\Entity\Patient;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SejourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
			->add('dateArrivee', DateType::class,['widget' => 'single_text','input'  => 'datetime_immutable', 'label'  =>'Date d\'Arrivee : '])
            ->add('dateDepart', DateType::class,['widget' => 'single_text','input'  => 'datetime_immutable', 'label'  =>'Date de Depart : '])
            ->add('Commentaire', TextType::class, array('label'=>'Commentaire optionnel : '))
            ->add('numChambre',EntityType::class, array('class'=>Chambre::class, 'choice_label'=>'id', 'placeholder'=>'Choisir une Chambre'))
            ->add('numPatient',EntityType::class, array('class'=>Patient::class, 'choice_label'=>'id', 'placeholder'=>'Choisir un Patient'))
			->add('save',SubmitType::class, array('label'=>'Enregistrer le Sejour'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sejour::class,
        ]);
    }
}
