<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Produit;
use App\Services\SerivicePanier;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripController extends AbstractController
{
    /**
     * @Route("/commande/create-session/{reference}", name="strip_create_session")
     * @param EntityManagerInterface $entityManager
     * @param SerivicePanier $cart
     * @param $reference
     * @return Response
     * @throws ApiErrorException
     */
    public function index(EntityManagerInterface $entityManager, SerivicePanier $cart, $reference): Response
    {
        header('Content-Type: application/json');
        $YOUR_DOMAIN = 'https://127.0.0.1:8000';
        $produitStrip = [];
        //Récuperation de la commande par sa réference
        $commande = $entityManager->getRepository(Commande::class)->findOneByCommandeReference($reference);
        if (!$commande){
            //Si la commande n'existe pas on renvoie une réponse en Json
            new JsonResponse(['error' => 'commande']);
        }
        foreach ($commande->getCommandeDetailsCommandeId()->getvalues() as $produit){ //Boucle de récuperation de chaque produit
            $Objet_produit= $entityManager->getRepository(Produit::class)->findOneByproduit_id($produit->getDetailsCommandeProduit());
            $produitStrip[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => ($produit->getDetailsCommandePrixVente()/100)*100, //Le prix du produit
                    'product_data' => [
                        'name' => $Objet_produit->getProduitLibelle(),
                      // 'images' => [$YOUR_DOMAIN."/public/img/PRODUITS/".$Objet_produit->getProduitPhoto()], //Image du produit
                    ],
                ],
                'quantity' => $produit->getDetailsCommandeQuantite() //La quantite pour chaque produit
            ];
        }
        Stripe::setApiKey($_ENV['SP_APIKEY_PRIVATE']);
        $checkout_session = Session::create([ // Création de la session
            'customer_email'=>$this->getUser()->getClientEmail(),
            'payment_method_types' => ['card'],
            'line_items' => [$produitStrip],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/commande/merci/{CHECKOUT_SESSION_ID}', //Page de destination si le payement s'est bien réaliser
            'cancel_url' => $YOUR_DOMAIN . '/commande/erreur/{CHECKOUT_SESSION_ID}', //Page de destination si le payement ne s'est pas réaliser
        ]);
        $commande->setCommandeStripIdSession($checkout_session->id);
        $entityManager->flush();
        $response = new JsonResponse(['id' => $checkout_session->id]);
        return $response;
    }
}
