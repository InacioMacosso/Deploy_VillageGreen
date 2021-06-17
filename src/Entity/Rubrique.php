<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Rubrique
 *
 * @ORM\Table(name="rubrique")
 * @ORM\Entity
 */
class Rubrique
{
    /**
     * @var int
     *
     * @ORM\Column(name="rubrique_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $rubriqueId;

    /**
     * @var string
     *
     * @ORM\Column(name="rubrique_nom", type="string", length=100, nullable=false)
     */
    private $rubriqueNom;

    /**
     * @ORM\OneToMany(targetEntity=Sousrubrique::class, mappedBy="sousrubrique_rubrique_id")
     */
    private $sousrubriques;

    /**
     * Rubrique constructor.
     */
    public function __construct()
    {
        $this->sousrubriques=new ArrayCollection;
    }

    public function __toString(): ?string
    {
        return $this->getRubriqueNom();
    }

    public function getRubriqueId(): ?int
    {
        return $this->rubriqueId;
    }

    public function getRubriqueNom(): ?string
    {
        return $this->rubriqueNom;
    }

    public function setRubriqueNom(string $rubriqueNom): self
    {
        $this->rubriqueNom = $rubriqueNom;

        return $this;
    }

    /**
     * @return Collection|Sousrubrique[]
     */
    public function getSousrubriques(): Collection
    {
        return $this->sousrubriques;
    }
    public function addSousrubriques(Sousrubrique $sousrubrique): self
    {
        if (!$this->sousrubriques->contains($sousrubrique)) {
            $this->sousrubriques[] = $sousrubrique;
            $sousrubrique->setSousrubriqueRubrique($this);
        }

        return $this;
    }
    public function removeSousrubriques(Sousrubrique $sousrubrique): self
    {
        if ($this->sousrubriques->removeElement($sousrubrique)) {
            // set the owning side to null (unless already changed)
            if ($sousrubrique->getSousrubriqueRubrique() === $this) {
                $sousrubrique->setSousrubriqueRubrique(null);
            }
        }
        return $this;
    }
}
