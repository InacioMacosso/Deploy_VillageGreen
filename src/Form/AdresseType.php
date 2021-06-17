<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adresseNomcomplet',TextType::class, [
                'label'=>'Nom de la personne',
                'attr'=>[
                    'placeholder'=>'Jean Bidon',
                    'required'=>false,
                ]
            ])
            ->add('adresseEntreprise',TextType::class, [
                'label'=>'Entreprise',
                'required'=>false,
                'attr'=>[
                    'placeholder'=>'Ringo Company'
                ]
            ])
            ->add('adresseTelephone', NumberType::class, [
                'label'=>'Numéro de téléphone',
                'attr'=>[
                    'placeholder'=>'0700000000'
                ]
            ])

            ->add('adresseNumeroRue',TextType::class, [
                'label'=>'Numéro, Rue',
                'attr'=>[
                    'placeholder'=>'3, rue de toto'
                ]
            ])
            ->add('adresseCodepostal',TextType::class, [
                'label'=>'Code Postal',
                'attr'=>[
                    'placeholder'=>'80000'
                ]
            ])
            ->add('adresseVille',TextType::class, [
                'label'=>'Ville',
                'attr'=>[
                    'placeholder'=>'Amiens'
                ]
            ])
            ->add('adressePays',CountryType::class, [
                'label'=>'Pays'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
