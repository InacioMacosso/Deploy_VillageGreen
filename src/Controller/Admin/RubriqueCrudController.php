<?php

namespace App\Controller\Admin;

use App\Entity\Rubrique;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RubriqueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rubrique::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('rubrique_id', 'ID')->hideOnForm(),
            TextField::new('rubrique_nom', 'NOM'),
        ];
    }
}
