<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('produit_id', 'ID')->hideOnForm(),
            TextField::new('produit_libelle', 'LIBELLE'),
            TextEditorField::new('produit_description', 'DESCRIPTION'),
            MoneyField::new('produit_prix_HT', 'PRIX HT')->setCurrency('EUR'),
            ImageField::new('produit_photo', 'IMAGE')->setBasePath('/img/PRODUITS/')
                ->setUploadDir('/public/img/PRODUITS/'),
            NumberField::new('produit_stock', 'STOCK'),
            AssociationField::new('produit_sousrubrique_id', 'SOUS-RUBRIQUE'),
            BooleanField::new('produit_actif', 'DESACTIF'),
        ];
    }

}
