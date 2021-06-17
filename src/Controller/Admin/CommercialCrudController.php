<?php

namespace App\Controller\Admin;

use App\Entity\Commercial;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommercialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commercial::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('commercial_id', 'ID')->hideOnForm(),
            TextField::new('commercial_nom', 'NOM'),
            TextField::new('commercial_prenom', 'PRENOM'),
            TelephoneField::new('commercial_tel', 'TELEPHONE'),
            EmailField::new('commercial_email', 'EMAIL')
        ];
    }

}
