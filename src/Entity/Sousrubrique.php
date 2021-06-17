<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sousrubrique
 *
 * @ORM\Table(name="sousrubrique", indexes={@ORM\Index(name="sousrubrique_fk_1", columns={"sousrubrique_rubrique_id"})})
 * @ORM\Entity
 */
class Sousrubrique
{
    /**
     * @var int
     *
     * @ORM\Column(name="sousrubrique_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $sousrubriqueId;

    /**
     * @var string
     *
     * @ORM\Column(name="sousrubrique_nom", type="string", length=100, nullable=false)
     */
    private $sousrubriqueNom;

    /**
     * @var \Rubrique
     *
     * @ORM\ManyToOne(targetEntity="Rubrique")
     * @ORM\JoinColumn(name="sousrubrique_rubrique_id", referencedColumnName="rubrique_id")
     */
    private $sousrubrique_rubrique_id;

    public function __toString(){
        return $this->getSousrubriqueNom();
    }
    public function getSousrubriqueId(): ?int
    {
        return $this->sousrubriqueId;
    }

    public function getSousrubriqueNom(): ?string
    {
        return $this->sousrubriqueNom;
    }

    public function setSousrubriqueNom(string $sousrubriqueNom): self
    {
        $this->sousrubriqueNom = $sousrubriqueNom;

        return $this;
    }

    public function getSousrubriqueRubriqueId(): ?Rubrique
    {
        return $this->sousrubrique_rubrique_id;
    }

    public function setSousrubriqueRubriqueId(?Rubrique $sousrubriqueRubrique): self
    {
        $this->sousrubrique_rubrique_id = $sousrubriqueRubrique;

        return $this;
    }


}
