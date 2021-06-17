<?php
namespace App\Services;
use App\Repository\ProduitsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SerivicePanier{
    private $session;
    private $produitRepos;
    private $tvaUnitaire = 0.2;

    public function __construct(SessionInterface $session, ProduitsRepository $produitRepos) {
        $this->session =$session;
        $this->produitRepos=$produitRepos;
    }

    public function addToPanier($id){
        $panier=$this->getPanier();
        if (isset($panier[$id])){
            //Produit existe dans le panier
            $panier[$id]++;

        }else{
            //Produit n'existe pas dans le panier
            $panier[$id]=1;
        }
        $this->updatePanier($panier);
    }

    public function deleteFromPanier($id){
        $panier=$this->getPanier();
        if (isset($panier[$id])){
            //Produit existe dans le panier
            if ($panier[$id]>1){
                //Produit quantite superieur a 1 dans le panier
                $panier[$id]--;
            }else{
                //Produit quentite = 1 dans le panier
                unset($panier[$id]);
            }
            $this->updatePanier($panier);
        }
    }

    public function deleteAllToPanier($id){
        $panier=$this->getPanier();
        if (isset($panier[$id])){
            //Produit existe dans le panier
            unset($panier[$id]);
        }
        $this->updatePanier($panier);
    }

    public function deletePanier(){
        $this->updatePanier([]);
    }
    public function updatePanier($panier){
        $this->session->set('panier', $panier);
        $this->session->set('donneesPanier', $this->getFullPanier());
    }

    public function getPanier()
    {
        return $this->session->get('panier', []);
    }
    public function getFullPanier(){
        $panier=$this->getPanier();
        $fullPanier = [];
        $quantitePanier =0;
        $sousTotal = 0;
        foreach ($panier as $id => $quantite){
            $produit=$this->produitRepos->find($id);
            if($produit){
                //Produit récupéré avec success
                $fullPanier['produits'][]=[
                    'quantite'=>$quantite,
                    'produit'=>$produit,
                ];
                $quantitePanier +=$quantite;
                $sousTotal += $quantite * $produit->getProduitPrixHt()/100;

            }else{
                //id incorrect
                $this->deleteFromPanier($id);
            }
        }
        $fullPanier['donnees']=[
            'quantitePanier'=>$quantitePanier,
            'sousTotal'=>$sousTotal,
            'tva'=>round($sousTotal*$this->tvaUnitaire, 2),
            'soustotalTTC'=>round($sousTotal + ($sousTotal*$this->tvaUnitaire),2),
            'tvaUnitaire'=>$this->tvaUnitaire,
        ];
        return $fullPanier;
    }
}
