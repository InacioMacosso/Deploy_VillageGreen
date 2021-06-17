<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="produit_fk_1", columns={"produit_sousrubrique_id"})})
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="produit_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $produitId;

    /**
     * @var string
     *
     * @ORM\Column(name="produit_libelle", type="string", length=250, nullable=false)
     */
    private $produitLibelle;

    /**
     * @var string
     *
     * @ORM\Column(name="produit_description", type="text", length=65535, nullable=false)
     */
    private $produitDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="produit_prix_HT", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $produitPrixHt;

    /**
     * @var string
     *
     * @ORM\Column(name="produit_photo", type="string", length=250, nullable=false)
     */
    private $produitPhoto;

    /**
     * @var int
     *
     * @ORM\Column(name="produit_stock", type="integer", nullable=false)
     */
    private $produitStock;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="produit_actif", type="boolean", nullable=true)
     */
    private $produit_actif;

    /**
     * @var \Sousrubrique
     *
     * @ORM\ManyToOne(targetEntity="Sousrubrique")
     *   @ORM\JoinColumn(name="produit_sousrubrique_id", referencedColumnName="sousrubrique_id")
     */
    private $produit_sousrubrique_id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Fournisseur", inversedBy="approvissionnerProduit")
     * @ORM\JoinTable(name="approvissionner",
     *   joinColumns={
     *     @ORM\JoinColumn(name="approvissionner_produit_id", referencedColumnName="produit_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="approvissionner_fournisseur_id", referencedColumnName="fournisseur_id")
     *   }
     * )
     */
    private $approvissionnerFournisseur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Livraison", inversedBy="colisProduit")
     * @ORM\JoinTable(name="colis",
     *   joinColumns={
     *     @ORM\JoinColumn(name="colis_produit_id", referencedColumnName="produit_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="colis_livraison_id", referencedColumnName="livraison_id")
     *   }
     * )
     */
    private $colisLivraison;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->approvissionnerFournisseur = new \Doctrine\Common\Collections\ArrayCollection();
        $this->colisLivraison = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getProduitId(): ?int
    {
        return $this->produitId;
    }

    public function getProduitLibelle(): ?string
    {
        return $this->produitLibelle;
    }

    public function setProduitLibelle(string $produitLibelle): self
    {
        $this->produitLibelle = $produitLibelle;

        return $this;
    }

    public function getProduitDescription(): ?string
    {
        return $this->produitDescription;
    }

    public function setProduitDescription(string $produitDescription): self
    {
        $this->produitDescription = $produitDescription;

        return $this;
    }

    public function getProduitPrixHt(): ?string
    {
        return $this->produitPrixHt;
    }

    public function setProduitPrixHt(string $produitPrixHt): self
    {
        $this->produitPrixHt = $produitPrixHt;

        return $this;
    }

    public function getProduitPhoto(): ?string
    {
        return $this->produitPhoto;
    }

    public function setProduitPhoto(string $produitPhoto): self
    {
        $this->produitPhoto = $produitPhoto;

        return $this;
    }

    public function getProduitStock(): ?int
    {
        return $this->produitStock;
    }

    public function setProduitStock(int $produitStock): self
    {
        $this->produitStock = $produitStock;

        return $this;
    }

    public function getProduitActif(): ?bool
    {
        return $this->produit_actif;
    }

    public function getProduit_actif(): ?bool
    {
        return $produitActif= $this->produit_actif;
    }
    public function setProduitActif(?bool $produitActif): self
    {
        $this->produit_actif = $produitActif;

        return $this;
    }

    public function getProduit_sousrubrique_id(): ?Sousrubrique
    {
        return $this->produit_sousrubrique_id;
    }

    public function getProduitSousrubriqueId(): ?Sousrubrique
    {
        return $this->produit_sousrubrique_id;
    }

    public function setProduitSousrubriqueId(?Sousrubrique $produitSousrubrique): self
    {
        $this->produit_sousrubrique_id = $produitSousrubrique;

        return $this;
    }

    /**
     * @return Collection|Fournisseur[]
     */
    public function getApprovissionnerFournisseur(): Collection
    {
        return $this->approvissionnerFournisseur;
    }

    public function addApprovissionnerFournisseur(Fournisseur $approvissionnerFournisseur): self
    {
        if (!$this->approvissionnerFournisseur->contains($approvissionnerFournisseur)) {
            $this->approvissionnerFournisseur[] = $approvissionnerFournisseur;
        }

        return $this;
    }

    public function removeApprovissionnerFournisseur(Fournisseur $approvissionnerFournisseur): self
    {
        $this->approvissionnerFournisseur->removeElement($approvissionnerFournisseur);

        return $this;
    }

    /**
     * @return Collection|Livraison[]
     */
    public function getColisLivraison(): Collection
    {
        return $this->colisLivraison;
    }

    public function addColisLivraison(Livraison $colisLivraison): self
    {
        if (!$this->colisLivraison->contains($colisLivraison)) {
            $this->colisLivraison[] = $colisLivraison;
        }

        return $this;
    }

    public function removeColisLivraison(Livraison $colisLivraison): self
    {
        $this->colisLivraison->removeElement($colisLivraison);

        return $this;
    }

}
