<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CancelerCommandeController extends AbstractController
{
    /**
     * @Route("/canceler/commande", name="canceler_commande")
     */
    public function index(): Response
    {
        return $this->render('canceler_commande/index.html.twig', [
            'controller_name' => 'CancelerCommandeController',
        ]);
    }
}
