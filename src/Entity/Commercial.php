<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commercial
 *
 * @ORM\Table(name="commercial", uniqueConstraints={@ORM\UniqueConstraint(name="commercial_email", columns={"commercial_email"})})
 * @ORM\Entity
 */
class Commercial
{
    /**
     * @var int
     *
     * @ORM\Column(name="commercial_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $commercialId;

    /**
     * @var string
     *
     * @ORM\Column(name="commercial_nom", type="string", length=50, nullable=false)
     */
    private $commercialNom;

    /**
     * @var string
     *
     * @ORM\Column(name="commercial_prenom", type="string", length=50, nullable=false)
     */
    private $commercialPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="commercial_tel", type="string", length=15, nullable=false)
     */
    private $commercialTel;

    /**
     * @var string
     *
     * @ORM\Column(name="commercial_email", type="string", length=250, nullable=false)
     */
    private $commercialEmail;

    /**
     * @ORM\OneToMany(targetEntity=Client::class, mappedBy="client_commercial_id")
     */
    private $commercialClients;

    /**
     * Commercial constructor.
     */
    public function __construct()
    {
        $this->commercialClients = new ArrayCollection();
    }

    public function __toString(): ?string
    {
        return $this->getCommercialNom();
    }

    public function getCommercialId(): ?int
    {
        return $this->commercialId;
    }

    public function getCommercialNom(): ?string
    {
        return $this->commercialNom;
    }

    public function setCommercialNom(string $commercialNom): self
    {
        $this->commercialNom = $commercialNom;

        return $this;
    }

    public function getCommercialPrenom(): ?string
    {
        return $this->commercialPrenom;
    }

    public function setCommercialPrenom(string $commercialPrenom): self
    {
        $this->commercialPrenom = $commercialPrenom;

        return $this;
    }

    public function getCommercialTel(): ?string
    {
        return $this->commercialTel;
    }

    public function setCommercialTel(string $commercialTel): self
    {
        $this->commercialTel = $commercialTel;

        return $this;
    }

    public function getCommercialEmail(): ?string
    {
        return $this->commercialEmail;
    }

    public function setCommercialEmail(string $commercialEmail): self
    {
        $this->commercialEmail = $commercialEmail;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getCommercialClients(): Collection
    {
        return $this->commercialClients;
    }

    public function addCommercialClients(Client $commercialClient): self
    {
        if (!$this->commercialClients->contains($commercialClient)) {
            $this->commercialClients[] = $commercialClient;
            $commercialClient->setClientCommercialId($this);
        }

        return $this;
    }

    public function removeCommercialClients(Client $commercialClient): self
    {
        if ($this->commercialClients->removeElement($commercialClient)) {
            // set the owning side to null (unless already changed)
            if ($commercialClient->getClientCommercialId() === $this) {
                $commercialClient->setClientCommercialId(null);
            }
        }

        return $this;
    }
}
