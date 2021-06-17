<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Services\SerivicePanier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ValiderCommandeController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/commande/merci/{stripSessionId}", name="commande_valider")
     * @param $stripSessionId
     * @param SerivicePanier $cart
     * @return Response
     */
    public function index($stripSessionId, SerivicePanier $cart): Response
    {
        $commande= $this->entityManager->getRepository(Commande::class)->findOneBycommande_strip_id_session($stripSessionId);
        if (!$commande){
            return $this->redirectToRoute('home');
        }
        if (!$commande->getCommandePayer()){
            //Vider le panier
            $cart->deletePanier();
            //Modification du statut de cmdPayer a true
            $commande->setCommandePayer(1);
            $this->entityManager->flush();
        }

        return $this->render('valider_commande/index.html.twig', [
            'commande'=>$commande
        ]);
    }
}
