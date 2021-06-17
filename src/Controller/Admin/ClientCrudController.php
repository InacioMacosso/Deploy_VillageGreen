<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('client_id', 'ID')->hideOnForm(),
            TextField::new('client_nom', 'NOM'),
            TextField::new('client_prenom', 'PRENOM'),
            EmailField::new('client_email', 'EMAIL'),
            AssociationField::new('client_categorie_id', 'CATEGORIE'),
            AssociationField::new('client_commercial_id', 'COMMERCIAL'),
            BooleanField::new('isVerified', "VERIFICATION D'EMAIL"),
        ];
    }
}
