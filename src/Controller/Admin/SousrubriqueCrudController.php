<?php

namespace App\Controller\Admin;

use App\Entity\Sousrubrique;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SousrubriqueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sousrubrique::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('sousrubrique_id', 'ID')->hideOnForm(),
            TextField::new('sousrubrique_nom', 'NOM'),
            AssociationField::new('sousrubrique_rubrique_id', 'SOUS-RUBRIQUE')
        ];
    }
}
