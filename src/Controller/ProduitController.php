<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/produit")
 */
class ProduitController extends AbstractController
{
    /**
     * @Route("/", name="produit_index", methods={"GET"})
     * @param ProduitsRepository $produitsRepository
     * @return Response
     */
    public function index(ProduitsRepository $produitsRepository): Response
    {
        $produits = $produitsRepository->findBy(['produit_actif'=>0]);// Les produits qui peuvent être afficher sont réprensetés par 0;
        return $this->render('produit/index.html.twig', [
            'produits' => $produits
        ]);
    }

    /**
     * @Route("/{produitId}", name="produit_show", methods={"GET"})
     * @param Produit|null $produit
     * @return Response
     */
    public function show(?Produit $produit): Response
    {
        if(!$produit){
            return $this->redirectToRoute('home');
        }
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

}
