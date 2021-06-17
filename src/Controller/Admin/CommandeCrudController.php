<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add('index', 'detail');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('commande_id', 'Id')->hideOnForm(),
            TextField::new('commande_client_id.nomcomplet', 'Client'),
            DateTimeField::new('commande_date', 'Date de Commande'),
            PercentField::new('commande_reduction', 'Reduction')->hideOnIndex(),
            TextField::new('commande_adresse_facturation', 'Adresse de facturation')->hideOnIndex(),
            TextField::new('commande_adresse_livraison', 'Adresse de livraison')->hideOnIndex(),
            BooleanField::new('commande_payer', 'Payer ?'),
            TextField::new('commande_reference', 'Reference'),
            MoneyField::new('Total')->setCurrency('EUR')
           // AssociationField::new('commande_details_commande_id', 'Dteail de la commande'),
        ];
    }

}
