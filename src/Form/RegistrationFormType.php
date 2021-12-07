<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Regex(
                        [
                            'pattern'=> '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,16}$/'
                        ]
                    )
                ],
            ])
            ->add('roles', ChoiceType::class, [
                'choices'=>array(
                    'admin'=>'ROLE_ADMIN', 'infirmier'=>'ROLE_INFIRMIER',
                    'user'=>'ROLE_USER'),
                'attr'=>array('onchange' => 'if(registration_form_roles_1.checked === true){document.getElementById("registration_form_numService").hidden = false;document.getElementById("registration_form_numService").required = true;}else{document.getElementById("registration_form_numService").hidden = true;}'),
                'expanded'=>true,
                'multiple'=>true

            ])
            ->add('numService', EntityType::class, array(
                        'class'=> Service::class,
                        'placeholder' => 'Choisir un Service',
                        'attr'=>array(
                            'hidden'=>true                            
                        ),
                        'label'=>'Service de l\'utilisateur : ',
                        'choice_label'=>'nom',
                        'required' => false,
                        'expanded'=>false
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
