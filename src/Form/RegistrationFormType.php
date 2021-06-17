<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clientNom', TextType::class, [
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'col-auto col-form-label col-form-label-sm',
                ],
                'attr' => [
                    'placeholder' => 'Nom',
                    'class' => 'form-control form-control-sm',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez remplir ce champ']),
                    new Regex([
                        'pattern' => '/^[A-Za-z0-9\/éèàçâêûîôäëüïö\:\_\'\-\s]+$/',
                        'message' => 'Caratère(s) non valide(s)'
                    ]),
                ]
            ])
            ->add('clientPrenom', TextType::class, [
                'label' => 'Prénom',
                'label_attr' => [
                'class' => 'col-auto col-form-label col-form-label-sm',
                 ],
                'attr' => [
                    'placeholder' => 'Prénom',
                    'class' => 'form-control form-control-sm',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez remplir ce champ']),
                    new Regex([
                        'pattern' => '/^[A-Za-z0-9\/éèàçâêûîôäëüïö\:\_\'\-\s]+$/',
                        'message' => 'Caratère(s) non valide(s)'
                    ]),
                ]
            ])
            ->add('clientEmail', EmailType::class, [
                'label' => 'E-mail',
               'label_attr' => [
                    'class' => 'col-auto col-form-label col-form-label-sm',
               ],
                'attr' => [
                    'class' => 'form-control form-control-sm',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez remplir ce champ']),
                    new Regex([
                        'pattern' => '/^[\w\-.]+@([\w\-]+.)+[\w\-]{2,4}$/',
                        'message' => 'Caratère(s) non valide(s)'
                    ]),
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label'=>"J'accepte les conditions d'utilisation",
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('clientPassword', RepeatedType::class, [
                'type'=>PasswordType::class,
                'invalid_message'=>"Les deux passwords doivent être identiques",
                'label'=>"Mot de passe",
                'required'=>true,
                'first_options'=>['label'=>"Mot de passe",
                    'constraints'=> new Length([
                        'min' => 8,
                        'max' => 250,
                    ]),
                    'attr'=>[
                        'placeholder'=>"Veillez saisir votre mot de passe",
                        'class' => 'form-control form-control-sm'
                    ]
                ],
                'second_options'=>['label'=>"Mot de passe",
                    'attr'=>[
                        'placeholder'=>"Veillez confirmer votre mot de passe",
                        'class' => 'form-control form-control-sm'
                    ]
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
