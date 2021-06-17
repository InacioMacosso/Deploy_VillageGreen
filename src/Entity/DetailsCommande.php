<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DetailsCommande
 *
 * @ORM\Table(name="details_commande", indexes={@ORM\Index(name="details_commande_fk_2", columns={"details_commande_produit_id"}), @ORM\Index(name="details_commande_fk_1", columns={"details_commande_commande_id"})})
 * @ORM\Entity
 */
class DetailsCommande
{
    /**
     * @var int
     *
     * @ORM\Column(name="details_commande_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $detailsCommandeId;

    /**
     * @var int
     *
     * @ORM\Column(name="details_commande_quantite", type="integer", nullable=false)
     */
    private $detailsCommandeQuantite;

    /**
     * @var string
     *
     * @ORM\Column(name="details_commande_prix_vente_", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $detailsCommandePrixVente;

    /**
     * @var string
     *
     * @ORM\Column(name="details_commande_total", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $detailsCommandeTotal;

    /**
     * @var \Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="details_commande_commande_id", referencedColumnName="commande_id")
     * })
     */
    private $details_commande_commande_id;

    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="details_commande_produit_id", referencedColumnName="produit_id")
     * })
     */
    private $details_commande_produit_id;

    public function getDetailsCommandeId(): ?int
    {
        return $this->detailsCommandeId;
    }

    public function getDetailsCommandeQuantite(): ?int
    {
        return $this->detailsCommandeQuantite;
    }

    public function setDetailsCommandeQuantite(int $detailsCommandeQuantite): self
    {
        $this->detailsCommandeQuantite = $detailsCommandeQuantite;

        return $this;
    }

    public function getDetailsCommandePrixVente(): ?string
    {
        return $this->detailsCommandePrixVente;
    }

    public function setDetailsCommandePrixVente(string $detailsCommandePrixVente): self
    {
        $this->detailsCommandePrixVente = $detailsCommandePrixVente;

        return $this;
    }

    public function getDetailsCommandeTotal(): ?string
    {
        return $this->detailsCommandeTotal;
    }

    public function setDetailsCommandeTotal(string $detailsCommandeTotal): self
    {
        $this->detailsCommandeTotal = $detailsCommandeTotal;

        return $this;
    }

    public function getDetailsCommandeCommande(): ?Commande
    {
        return $this->details_commande_commande_id;
    }

    public function setDetailsCommandeCommande(?Commande $detailsCommandeCommande): self
    {
        $this->details_commande_commande_id = $detailsCommandeCommande;

        return $this;
    }

    public function getDetailsCommandeProduit(): ?Produit
    {
        return $this->details_commande_produit_id;
    }

    public function setDetailsCommandeProduit(?Produit $detailsCommandeProduit): self
    {
        $this->details_commande_produit_id = $detailsCommandeProduit;

        return $this;
    }


}
