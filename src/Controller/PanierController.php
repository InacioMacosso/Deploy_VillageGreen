<?php

namespace App\Controller;

use App\Services\SerivicePanier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    private $serivicePanier;
    public function __construct(SerivicePanier $serivicePanier)
    {
        $this->serivicePanier=$serivicePanier;
    }

    /**
     * @Route("/panier", name="panier")
     * @return Response
     */
    public function index(): Response
    {
        $panier = $this->serivicePanier->getFullPanier(); // O récupere le panier entier de la classe ServicePanier
        if(!isset($panier['produits'])){                 // On vérifie si la varible produits est vide. Si c'est le cas,
            return $this->redirectToRoute('produit_index');// l'utilisateur est rédictionner vers le catalogue des produits.
        }
        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
        ]);
    }

    /**
     * @Route("/panier/add/{produitId}", name="add_to_panier")
     * @param $produitId
     * @return Response
     */
    public function addToPanier($produitId): Response
    {
        //Ajoute un article dans le panier
        $this->serivicePanier->addToPanier($produitId);
        return $this->redirectToRoute('panier');
    }

    /**
     * @Route("/panier/remove", name="remove_panier")
     * @return Response
     */
    public function remove(): Response
    {
        //suprime tout le panier
        $this->serivicePanier->deletePanier();
        return $this->redirectToRoute('produit_index');
    }

    /**
     * @Route("/panier/delete/{produitId}", name="delete_to_panier")
     * @param $produitId
     * @return Response
     */
    public function delete($produitId): Response
    {
        //suprime tout les articles d'une meme nature dans le panier
        $this->serivicePanier->deleteAllToPanier($produitId);
        return $this->redirectToRoute('panier');
    }

    /**
     * @Route("/panier/reduir/{produitId}", name="reduir_from_panier")
     * @param $produitId
     * @return Response
     */
    public function reduir($produitId): Response
    {
        //Reduit un article du le panier;
        $this->serivicePanier->deleteFromPanier($produitId);
        return $this->redirectToRoute('panier');
    }
}
