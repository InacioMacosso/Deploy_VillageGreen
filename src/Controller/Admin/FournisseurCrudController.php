<?php

namespace App\Controller\Admin;

use App\Entity\Fournisseur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FournisseurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Fournisseur::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('fournisseur_id', 'ID')->hideOnForm(),
            TextField::new('fournisseur_nom', 'NOM'),
            TextField::new('fournisseur_numero_rue', 'ADRESSE'),
            TextField::new('fournisseur_codepostal', 'CODE POSTAL'),
            TextField::new('fournisseur_ville', 'VILLE'),
            CountryField::new('fournisseur_pays', 'PAYS'),
            TelephoneField::new('fournisseur_tel', 'TELEPHONE'),
        ];
    }

}
