<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture", uniqueConstraints={@ORM\UniqueConstraint(name="facture_commande_id", columns={"facture_commande_id"})})
 * @ORM\Entity
 */
class Facture
{
    /**
     * @var int
     *
     * @ORM\Column(name="facture_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $factureId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="facture_date", type="datetime", nullable=false)
     */
    private $factureDate;

    /**
     * @var \Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="facture_commande_id", referencedColumnName="commande_id")
     * })
     */
    private $factureCommande;

    public function getFactureId(): ?int
    {
        return $this->factureId;
    }

    public function getFactureDate(): ?\DateTimeInterface
    {
        return $this->factureDate;
    }

    public function setFactureDate(\DateTimeInterface $factureDate): self
    {
        $this->factureDate = $factureDate;

        return $this;
    }

    public function getFactureCommande(): ?Commande
    {
        return $this->factureCommande;
    }

    public function setFactureCommande(?Commande $factureCommande): self
    {
        $this->factureCommande = $factureCommande;

        return $this;
    }


}
