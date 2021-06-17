<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\DetailsCommande;
use App\Form\CommandeType;
use App\Services\SerivicePanier;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    private $entityManager;
    private $panier;

    public function __construct(EntityManagerInterface $entityManager, SerivicePanier $panier)
    {
        $this->entityManager = $entityManager;
        $this->panier =$panier;
    }

    /**
     * @Route("/commande", name="commande")
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     */
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {

        $form = $this->createForm(CommandeType::class, null, [
            'user' => $this->getUser()
        ]);
        return $this->render('commande/index.html.twig', [
            'form' => $form->createView(),
            'panier' => $this->panier->getFullPanier()
        ]);
    }

    /**
     * @Route("/commande/recapitulatif", name="recap_commande", methods={"POST"})
     * @param Request $request
     * @param SerivicePanier $panier
     * @return Response
     */
    public function ajouter(Request $request, SerivicePanier $panier):Response
    {
        $form = $this->createForm(CommandeType::class, null, [
            'user' => $this->getUser()
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $coefficient= $this->getUser()->getclient_categorie_id()->getcategorieCoefficientClient();
            $date = new DateTime;
            $adresseFact = $form->get("adresseFact")->getData();
            $adresseLiv = $form->get("adresseLiv")->getData();

            // Enregistrement dans la table commande
            $commande = new Commande();
            $reference = $date->format('dmy') . '-' . uniqid();
            $commande->setCommandeDate($date);
            $commande->setCommandeReference($reference);
            $commande->setCommandeAdresseFacturation($adresseFact->getAdresseNumeroRue().' '.$adresseFact->getAdresseCodepostal().' '.$adresseFact->getAdresseVille().'-'.$adresseFact->getAdressePays());
            $commande->setCommandeAdresseLivraison($adresseLiv->getAdresseNumeroRue().' '.$adresseFact->getAdresseCodepostal().' '.$adresseFact->getAdresseVille().'-'.$adresseFact->getAdressePays());
            $commande->setCommandePayer(0);
            $commande->setCommandeClientId($this->getUser());
         $this->entityManager->persist($commande); //Persistance des donnees de la commande

            //Enregistrement dans DetailCommande()

            $prod = $panier->getFullPanier()["produits"];
            foreach ($prod as $id=> $produits) {
                $tva = $produits["produit"]->getProduitPrixHt() * 0.2;
                    $detailCmd = new DetailsCommande();
                    $detailCmd->setDetailsCommandeCommande($commande);
                    $detailCmd->setDetailsCommandeProduit($produits["produit"]);
                    $detailCmd->setDetailsCommandeQuantite($produits["quantite"]);
                    $detailCmd->setDetailsCommandePrixVente((($produits["produit"]->getProduitPrixHt()) + $tva)*$coefficient);
                    $detailCmd->setDetailsCommandeTotal($produits["quantite"] * (($produits["produit"]->getProduitPrixHt()+ $tva)*$coefficient ));
                    $this->entityManager->persist($detailCmd);
            }
            $this->entityManager->flush();
            return $this->render('commande/ajout.html.twig', [
                'panier' => $this->panier->getFullPanier(),
                'adresseLiv' => $adresseLiv,
                'adresseFac' => $adresseFact,
                'reference' => $commande->getCommandeReference(),
                'apikeypublic' => $_ENV['SP_APIKEY_PUBLIC']
            ]);
        }
        return $this->redirectToRoute('panier');

    }


}




