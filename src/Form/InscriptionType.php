<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;


class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('roles', CollectionType::class, [
                'entry_type' => ChoiceType::class,
                'entry_options' => [
                    'label' => false,
                    'choices' => [
                        'Utilisateur' => 'ROLE_USER',
                        'Administrateur' => 'ROLE_ADMIN',
                    ],
                ],
                'required' => false,
                'empty_data' => '["ROLE_USER"]',
            ])
            ->add('password', RepeatedType::class,[
                'type'=> PasswordType::class,
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'minMessage' => "Mot de passe trop court."
                    ]),
                    new Regex([
                        'pattern' => '/\d/',
                        'message' => "Votre mot de passe doit contenir au moins un chiffre."
                    ])
                ],
                'invalid_message'=> 'Les mots de passe doivent être identiques',
                'options'=> ['attr'=>['class'=>'password-field']],
                'required'=> true,
                'first_options'=> ['label'=> 'Mot de passe'],
                'second_options'=> ['label'=> 'Confirmation du Mot de passe'],
                'mapped' => false,
            ])
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
