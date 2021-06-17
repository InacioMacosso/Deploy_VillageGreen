<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Fournisseur
 *
 * @ORM\Table(name="fournisseur")
 * @ORM\Entity
 */
class Fournisseur
{
    /**
     * @var int
     *
     * @ORM\Column(name="fournisseur_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fournisseurId;

    /**
     * @var string
     *
     * @ORM\Column(name="fournisseur_nom", type="string", length=250, nullable=false)
     */
    private $fournisseurNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fournisseur_numero_rue", type="string", length=250, nullable=true)
     */
    private $fournisseurNumeroRue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fournisseur_codepostal", type="string", length=10, nullable=true)
     */
    private $fournisseurCodepostal;

    /**
     * @var string
     *
     * @ORM\Column(name="fournisseur_ville", type="string", length=50, nullable=false)
     */
    private $fournisseurVille;

    /**
     * @var string
     *
     * @ORM\Column(name="fournisseur_pays", type="string", length=50, nullable=false)
     */
    private $fournisseurPays;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fournisseur_tel", type="string", length=14, nullable=true)
     */
    private $fournisseurTel;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Produit", mappedBy="approvissionnerFournisseur")
     */
    private $approvissionnerProduit;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->approvissionnerProduit = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getFournisseurId(): ?int
    {
        return $this->fournisseurId;
    }

    public function getFournisseurNom(): ?string
    {
        return $this->fournisseurNom;
    }

    public function setFournisseurNom(string $fournisseurNom): self
    {
        $this->fournisseurNom = $fournisseurNom;

        return $this;
    }

    public function getFournisseurNumeroRue(): ?string
    {
        return $this->fournisseurNumeroRue;
    }

    public function setFournisseurNumeroRue(?string $fournisseurNumeroRue): self
    {
        $this->fournisseurNumeroRue = $fournisseurNumeroRue;

        return $this;
    }

    public function getFournisseurCodepostal(): ?string
    {
        return $this->fournisseurCodepostal;
    }

    public function setFournisseurCodepostal(?string $fournisseurCodepostal): self
    {
        $this->fournisseurCodepostal = $fournisseurCodepostal;

        return $this;
    }

    public function getFournisseurVille(): ?string
    {
        return $this->fournisseurVille;
    }

    public function setFournisseurVille(string $fournisseurVille): self
    {
        $this->fournisseurVille = $fournisseurVille;

        return $this;
    }

    public function getFournisseurPays(): ?string
    {
        return $this->fournisseurPays;
    }

    public function setFournisseurPays(string $fournisseurPays): self
    {
        $this->fournisseurPays = $fournisseurPays;

        return $this;
    }

    public function getFournisseurTel(): ?string
    {
        return $this->fournisseurTel;
    }

    public function setFournisseurTel(?string $fournisseurTel): self
    {
        $this->fournisseurTel = $fournisseurTel;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getApprovissionnerProduit(): Collection
    {
        return $this->approvissionnerProduit;
    }

    public function addApprovissionnerProduit(Produit $approvissionnerProduit): self
    {
        if (!$this->approvissionnerProduit->contains($approvissionnerProduit)) {
            $this->approvissionnerProduit[] = $approvissionnerProduit;
            $approvissionnerProduit->addApprovissionnerFournisseur($this);
        }

        return $this;
    }

    public function removeApprovissionnerProduit(Produit $approvissionnerProduit): self
    {
        if ($this->approvissionnerProduit->removeElement($approvissionnerProduit)) {
            $approvissionnerProduit->removeApprovissionnerFournisseur($this);
        }

        return $this;
    }

}
