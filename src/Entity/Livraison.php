<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Livraison
 *
 * @ORM\Table(name="livraison", indexes={@ORM\Index(name="livraison_fk_1", columns={"livraison_commande_id"})})
 * @ORM\Entity
 */
class Livraison
{
    /**
     * @var int
     *
     * @ORM\Column(name="livraison_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $livraisonId;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="livraison_date", type="datetime", nullable=true)
     */
    private $livraisonDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="livraison_etat", type="string", length=100, nullable=true)
     */
    private $livraisonEtat;

    /**
     * @var \Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="livraison_commande_id", referencedColumnName="commande_id")
     * })
     */
    private $livraisonCommande;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Produit", mappedBy="colisLivraison")
     */
    private $colisProduit;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->colisProduit = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getLivraisonId(): ?int
    {
        return $this->livraisonId;
    }

    public function getLivraisonDate(): ?\DateTimeInterface
    {
        return $this->livraisonDate;
    }

    public function setLivraisonDate(?\DateTimeInterface $livraisonDate): self
    {
        $this->livraisonDate = $livraisonDate;

        return $this;
    }

    public function getLivraisonEtat(): ?string
    {
        return $this->livraisonEtat;
    }

    public function setLivraisonEtat(?string $livraisonEtat): self
    {
        $this->livraisonEtat = $livraisonEtat;

        return $this;
    }

    public function getLivraisonCommande(): ?Commande
    {
        return $this->livraisonCommande;
    }

    public function setLivraisonCommande(?Commande $livraisonCommande): self
    {
        $this->livraisonCommande = $livraisonCommande;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getColisProduit(): Collection
    {
        return $this->colisProduit;
    }

    public function addColisProduit(Produit $colisProduit): self
    {
        if (!$this->colisProduit->contains($colisProduit)) {
            $this->colisProduit[] = $colisProduit;
            $colisProduit->addColisLivraison($this);
        }

        return $this;
    }

    public function removeColisProduit(Produit $colisProduit): self
    {
        if ($this->colisProduit->removeElement($colisProduit)) {
            $colisProduit->removeColisLivraison($this);
        }

        return $this;
    }

}
