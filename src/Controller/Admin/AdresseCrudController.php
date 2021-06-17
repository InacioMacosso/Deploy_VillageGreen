<?php

namespace App\Controller\Admin;

use App\Entity\Adresse;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdresseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adresse::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('adresse_id', 'ID'),
            TextField::new('adresse_nomcomplet'),
            AssociationField::new('adresse_client_id'),
        ];
    }

}
