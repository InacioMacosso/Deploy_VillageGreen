<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user=$options['user'];
        $builder
            ->add('adresseLiv', EntityType::class, [
                'label'=>false,
                'required'=>true,
                'multiple'=>false,
                'class'=>Adresse::class,
                'expanded'=>true,
                'choices'=>$user->getClientAdresses(),
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez remplir ce champ']),
                    new NotNull(['message' => 'Veuillez remplir ce champ'])]
            ])
            ->add('adresseFact', EntityType::class, [
                'label'=>false,
                'required'=>true,
                'multiple'=>false,
                'class'=>Adresse::class,
                'expanded'=>true,
                'choices'=>$user->getClientAdresses(),
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez remplir ce champ']),
                    new NotNull(['message' => 'Veuillez remplir ce champ'])]
            ])

            ->add('submit', SubmitType::class, [
                'label'=>'Passer la commande',
                'attr'=>[
                    'class'=>'btn btn-success btn-block'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'user'=>array()
        ]);
    }
}
