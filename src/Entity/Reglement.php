<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reglement
 *
 * @ORM\Table(name="reglement", indexes={@ORM\Index(name="reglement_fk_1", columns={"reglement_facture_id"})})
 * @ORM\Entity
 */
class Reglement
{
    /**
     * @var int
     *
     * @ORM\Column(name="reglement_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reglementId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="reglement_date", type="datetime", nullable=false)
     */
    private $reglementDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reglement_montant", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $reglementMontant;

    /**
     * @var \Facture
     *
     * @ORM\ManyToOne(targetEntity="Facture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reglement_facture_id", referencedColumnName="facture_id")
     * })
     */
    private $reglementFacture;

    public function getReglementId(): ?int
    {
        return $this->reglementId;
    }

    public function getReglementDate(): ?\DateTimeInterface
    {
        return $this->reglementDate;
    }

    public function setReglementDate(\DateTimeInterface $reglementDate): self
    {
        $this->reglementDate = $reglementDate;

        return $this;
    }

    public function getReglementMontant(): ?string
    {
        return $this->reglementMontant;
    }

    public function setReglementMontant(?string $reglementMontant): self
    {
        $this->reglementMontant = $reglementMontant;

        return $this;
    }

    public function getReglementFacture(): ?Facture
    {
        return $this->reglementFacture;
    }

    public function setReglementFacture(?Facture $reglementFacture): self
    {
        $this->reglementFacture = $reglementFacture;

        return $this;
    }


}
