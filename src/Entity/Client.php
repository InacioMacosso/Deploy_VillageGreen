<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Client
 *
 * @ORM\Table(name="client", uniqueConstraints={@ORM\UniqueConstraint(name="client_email", columns={"client_email"})}, indexes={@ORM\Index(name="client_fk_1", columns={"client_categorie_id"}), @ORM\Index(name="client_fk_2", columns={"client_commercial_id"})})
 * @ORM\Entity
 * @UniqueEntity(fields={"clientEmail"}, message="There is already an account with this clientEmail")
 */
class Client implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="client_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $clientId;

    /**
     * @var string
     *
     * @ORM\Column(name="client_nom", type="string", length=50, nullable=false)
     */
    private $clientNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="client_prenom", type="string", length=50, nullable=true)
     */
    private $clientPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="client_email", type="string", length=250, nullable=false)
     */
    private $clientEmail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="client_password", type="string", length=250, nullable=true)
     */
    private $clientPassword;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client_categorie_id", referencedColumnName="categorie_id")
     * })
     */
    private $client_categorie_id;

    /**
     * @var \Commercial
     *
     * @ManyToOne(targetEntity="Commercial")
     * @JoinColumn(name="client_commercial_id", referencedColumnName="commercial_id")
     */
    private $client_commercial_id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Commande", mappedBy="passerClient")
     */
    private $passerCommande;

    /**
     * @ORM\Column(name="client_role", type="json", length=255)
     */
    private $clientRole;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\OneToMany(targetEntity=Adresse::class, mappedBy="adresse_client_id")
     */
    private $clientAdresses;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="commande_client_id")
     */
    private $commandes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->passerCommande = new \Doctrine\Common\Collections\ArrayCollection();
        $this->clientAdresses = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    public function getNomComplet(): string
    {
        return $this->getClientNom().' '.$this->getClientPrenom();
    }
    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function getClientNom(): ?string
    {
        return $this->clientNom;
    }

    public function setClientNom(string $clientNom): self
    {
        $this->clientNom = $clientNom;

        return $this;
    }

    public function getClientPrenom(): ?string
    {
        return $this->clientPrenom;
    }

    public function setClientPrenom(?string $clientPrenom): self
    {
        $this->clientPrenom = $clientPrenom;

        return $this;
    }

    public function getClientEmail(): ?string
    {
        return $this->clientEmail;
    }

    public function setClientEmail(string $clientEmail): self
    {
        $this->clientEmail = $clientEmail;

        return $this;
    }

    public function getClientPassword(): ?string
    {
        return $this->clientPassword;
    }

    public function setClientPassword(?string $clientPassword): self
    {
        $this->clientPassword = $clientPassword;

        return $this;
    }

    public function getClientCategorieId(): ?Categorie
    {
        return $this->client_categorie_id;
    }
    public function getclient_categorie_id(): ?Categorie
    {
        return $this->client_categorie_id;
    }
    public function setClientCategorieId(?Categorie $client_categorie_id): self
    {
        $this->client_categorie_id = $client_categorie_id;

        return $this;
    }

    public function getClientCommercialId(): ?Commercial
    {
        return $this->client_commercial_id;
    }

    public function setClientCommercialId(?Commercial $clientCommercial): self
    {
        $this->client_commercial_id = $clientCommercial;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getPasserCommande(): Collection
    {
        return $this->passerCommande;
    }

    public function addPasserCommande(Commande $passerCommande): self
    {
        if (!$this->passerCommande->contains($passerCommande)) {
            $this->passerCommande[] = $passerCommande;
            $passerCommande->addPasserClient($this);
        }

        return $this;
    }

    public function removePasserCommande(Commande $passerCommande): self
    {
        if ($this->passerCommande->removeElement($passerCommande)) {
            $passerCommande->removePasserClient($this);
        }

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->clientRole;
        // guarantee every user at least has ROLE_USER
        $roles = ['ROLE_USER'];
        return array_unique($roles);
    }

    public function getPassword(): ?string
    {
        return $this->getClientPassword();
    }

    public function getSalt(): string
    {
        return "";
    }

    public function getUsername(): ?string
    {
        return $this->getClientEmail();
    }

    public function eraseCredentials()
    {
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getClientRole(): ?string
    {
        return $this->clientRole;
    }

    public function setClientRole(string $clientRole): self
    {
        $this->clientRole = $clientRole;

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getClientAdresses(): Collection
    {
        return $this->clientAdresses;
    }

    public function addClientAdresses(Adresse $clientAdresse): self
    {
        if (!$this->clientAdresses->contains($clientAdresse)) {
            $this->clientAdresses[] = $clientAdresse;
            $clientAdresse->setAdresseClient($this);
        }

        return $this;
    }

    public function removeClientAdresses(Adresse $clientAdresse): self
    {
        if ($this->clientAdresses->removeElement($clientAdresse)) {
            // set the owning side to null (unless already changed)
            if ($clientAdresse->getAdresseClient() === $this) {
                $clientAdresse->setAdresseClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setCommandeClientId($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getCommandeClientId() === $this) {
                $commande->setCommandeClientId(null);
            }
        }

        return $this;
    }
}
