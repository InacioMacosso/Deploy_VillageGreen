<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse", indexes={@ORM\Index(name="adresse_fk_1", columns={"adresse_client_id"})})
 * @ORM\Entity
 */
class Adresse
{
    /**
     * @var int
     *
     * @ORM\Column(name="adresse_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $adresseId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse_nomcomplet", type="string", length=250, nullable=true)
     */
    private $adresseNomcomplet;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse_entreprise", type="string", length=250, nullable=true)
     */
    private $adresseEntreprise;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse_numero_rue", type="string", length=250, nullable=true)
     */
    private $adresseNumeroRue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse_codepostal", type="string", length=10, nullable=true)
     */
    private $adresseCodepostal;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_ville", type="string", length=50, nullable=false)
     */
    private $adresseVille;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_pays", type="string", length=50, nullable=false)
     */
    private $adressePays;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse_telephone", type="string", length=14, nullable=true)
     */
    private $adresseTelephone;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="clientAdresses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="adresse_client_id", referencedColumnName="client_id")
     * })
     */
    private $adresse_client_id;

    public function __toString(){
        return $this->getAdresseNumeroRue().'[br]'.$this->getAdresseCodepostal().'[br]'.$this->getAdresseVille().'-'.$this->getAdressePays();
    }

    public function getAdresseId(): ?int
    {
        return $this->adresseId;
    }

    public function getAdresseNomcomplet(): ?string
    {
        return $this->adresseNomcomplet;
    }

    public function setAdresseNomcomplet(?string $adresseNomcomplet): self
    {
        $this->adresseNomcomplet = $adresseNomcomplet;

        return $this;
    }

    public function getAdresseEntreprise(): ?string
    {
        return $this->adresseEntreprise;
    }

    public function setAdresseEntreprise(?string $adresseEntreprise): self
    {
        $this->adresseEntreprise = $adresseEntreprise;

        return $this;
    }

    public function getAdresseNumeroRue(): ?string
    {
        return $this->adresseNumeroRue;
    }

    public function setAdresseNumeroRue(?string $adresseNumeroRue): self
    {
        $this->adresseNumeroRue = $adresseNumeroRue;

        return $this;
    }

    public function getAdresseCodepostal(): ?string
    {
        return $this->adresseCodepostal;
    }

    public function setAdresseCodepostal(?string $adresseCodepostal): self
    {
        $this->adresseCodepostal = $adresseCodepostal;

        return $this;
    }

    public function getAdresseVille(): ?string
    {
        return $this->adresseVille;
    }

    public function setAdresseVille(string $adresseVille): self
    {
        $this->adresseVille = $adresseVille;

        return $this;
    }

    public function getAdressePays(): ?string
    {
        return $this->adressePays;
    }

    public function setAdressePays(string $adressePays): self
    {
        $this->adressePays = $adressePays;

        return $this;
    }

    public function getAdresseTelephone(): ?string
    {
        return $this->adresseTelephone;
    }

    public function setAdresseTelephone(?string $adresseTelephone): self
    {
        $this->adresseTelephone = $adresseTelephone;

        return $this;
    }

    public function getAdresseClientId(): ?Client
    {
        return $this->adresse_client_id;
    }

    public function setAdresseClientId(?Client $adresse_client_id): self
    {
        $this->adresse_client_id = $adresse_client_id;

        return $this;
    }


}
