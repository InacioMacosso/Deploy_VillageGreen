<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="commande_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $commandeId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="commande_date", type="datetime", nullable=false)
     */
    private $commandeDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commande_reduction", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $commandeReduction;

    /**
     * @var string
     *
     * @ORM\Column(name="commande_adresse_livraison", type="string", length=250, nullable=false)
     */
    private $commandeAdresseLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="commande_adresse_facturation", type="string", length=250, nullable=false)
     */
    private $commandeAdresseFacturation;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="commande_payer", type="boolean", nullable=true)
     */
    private $commandePayer;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commande_strip_id_session", type="string", length=250, nullable=true)
     */
    private $commandeStripIdSession;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Client", inversedBy="passerCommande")
     * @ORM\JoinTable(name="passer",
     *   joinColumns={
     *     @ORM\JoinColumn(name="passer_commande_id", referencedColumnName="commande_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="passer_client_id", referencedColumnName="client_id")
     *   }
     * )
     */
    private $passerClient;

    /**
     * @ORM\Column(name="commande_reference", type="string", length=255)
     */
    private $commandeReference;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="client_id")
     */
    private $commande_client_id;

    /**
     * @ORM\OneToMany(targetEntity=DetailsCommande::class, mappedBy="details_commande_commande_id")
     */
    private $commande_details_commande_id;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->passerClient = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getCommandeId(): ?int
    {
        return $this->commandeId;
    }

    public function getCommandeDate(): ?\DateTimeInterface
    {
        return $this->commandeDate;
    }

    public function setCommandeDate(\DateTimeInterface $commandeDate): self
    {
        $this->commandeDate = $commandeDate;

        return $this;
    }

    public function getCommandeReduction(): ?string
    {
        return $this->commandeReduction;
    }

    public function setCommandeReduction(?string $commandeReduction): self
    {
        $this->commandeReduction = $commandeReduction;

        return $this;
    }

    public function getCommandeAdresseLivraison(): ?string
    {
        return $this->commandeAdresseLivraison;
    }

    public function setCommandeAdresseLivraison(string $commandeAdresseLivraison): self
    {
        $this->commandeAdresseLivraison = $commandeAdresseLivraison;

        return $this;
    }

    public function getCommandeAdresseFacturation(): ?string
    {
        return $this->commandeAdresseFacturation;
    }

    public function setCommandeAdresseFacturation(string $commandeAdresseFacturation): self
    {
        $this->commandeAdresseFacturation = $commandeAdresseFacturation;

        return $this;
    }

    public function getCommandePayer(): ?bool
    {
        return $this->commandePayer;
    }

    public function setCommandePayer(?bool $commandePayer): self
    {
        $this->commandePayer = $commandePayer;

        return $this;
    }

    public function getCommandeStripIdSession(): ?string
    {
        return $this->commandeStripIdSession;
    }

    public function setCommandeStripIdSession(?string $commandeStripIdSession): self
    {
        $this->commandeStripIdSession = $commandeStripIdSession;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getPasserClient(): Collection
    {
        return $this->passerClient;
    }

    public function addPasserClient(Client $passerClient): self
    {
        if (!$this->passerClient->contains($passerClient)) {
            $this->passerClient[] = $passerClient;
        }

        return $this;
    }

    public function removePasserClient(Client $passerClient): self
    {
        $this->passerClient->removeElement($passerClient);

        return $this;
    }

    public function getCommandeReference(): ?string
    {
        return $this->commandeReference;
    }

    public function setCommandeReference(string $commande_reference): self
    {
        $this->commandeReference = $commande_reference;

        return $this;
    }

    public function getCommandeClientId(): ?Client
    {
        return $this->commande_client_id;
    }

    public function setCommandeClientId(?Client $commande_client_id): self
    {
        $this->commande_client_id = $commande_client_id;

        return $this;
    }

    /**
     * @return Collection|DetailsCommande[]
     */
    public function getCommandeDetailsCommandeId(): Collection
    {
        return $this->commande_details_commande_id;
    }

    public function addCommandeDetailsCommandeId(DetailsCommande $cmdDetCmdId): self
    {
        if (!$this->commande_details_commande_id->contains($cmdDetCmdId)) {
            $this->commande_details_commande_id[] = $cmdDetCmdId;
            $cmdDetCmdId->setDetailsCommandeId($this);
        }

        return $this;
    }

    public function removeCmdDetCmdId(DetailsCommande $cmdDetCmdId): self
    {
        if ($this->commande_details_commande_id->removeElement($cmdDetCmdId)) {
            // set the owning side to null (unless already changed)
            if ($cmdDetCmdId->getDetailsCommandeId()() === $this) {
                $cmdDetCmdId->setDetailsCommandeId(null);
            }
        }

        return $this;
    }

    public function getTotal()
    {
        $total =0;
        foreach ($this->getCommandeDetailsCommandeId()->getvalues() as $produit){
           $total = $total + ($produit->getDetailsCommandePrixVente()* $produit->getdetailsCommandeQuantite());
        }
    return $total;
    }

}
