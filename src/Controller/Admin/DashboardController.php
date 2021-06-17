<?php

namespace App\Controller\Admin;

use App\Entity\Adresse;
use App\Entity\Categorie;
use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Commercial;
use App\Entity\Fournisseur;
use App\Entity\Produit;
use App\Entity\Rubrique;
use App\Entity\Sousrubrique;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->setController(CommandeCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Village Green');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Categories des Clients', 'fas fa-list', Categorie::class);
        yield MenuItem::linkToCrud('Commerciaux', 'fas fa-list', Commercial::class);
        yield MenuItem::linkToCrud('Clients', 'fas fa-list', Client::class);
        yield MenuItem::linkToCrud('Adresse', 'fas fa-list', Adresse::class);
        yield MenuItem::linkToCrud('Rubrique', 'fas fa-list', Rubrique::class);
        yield MenuItem::linkToCrud('Sous-rubrique', 'fas fa-list', Sousrubrique::class);
        yield MenuItem::linkToCrud('Produits', 'fas fa-shopping-cart', Produit::class);
        yield MenuItem::linkToCrud('Fournisseur', 'fas fa-list', Fournisseur::class);
        yield MenuItem::linkToCrud('Commandes', 'fas fa-list', Commande::class);
    }
}
