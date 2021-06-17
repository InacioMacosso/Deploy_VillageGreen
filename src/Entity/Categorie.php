<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="categorie_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categorieId;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie_nom", type="string", length=50, nullable=false)
     */
    private $categorieNom;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie_coefficient_client", type="decimal", precision=4, scale=2, nullable=false)
     */
    private $categorieCoefficientClient;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categorieCoefficientClient = 2.00; 
    }

    public function __toString(): ?string
    {
        return $this->getCategorieNom();
    }

    public function getCategorieId(): ?int
    {
        return $this->categorieId;
    }

    public function getCategorieNom(): ?string
    {
        return $this->categorieNom;
    }

    public function setCategorieNom(string $categorieNom): self
    {
        $this->categorieNom = $categorieNom;

        return $this;
    }

    public function getCategorieCoefficientClient(): ?string
    {
        return $this->categorieCoefficientClient;
    }

    public function setCategorieCoefficientClient(string $categorieCoefficientClient): self
    {
        $this->categorieCoefficientClient = $categorieCoefficientClient;

        return $this;
    }

}
