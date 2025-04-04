<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 15)]
    private ?string $telephone = null;

    /**
     * @var Collection<int, Rendezvous>
     */
    #[ORM\OneToMany(targetEntity: Rendezvous::class, mappedBy: 'client')]
    private Collection $rendezvous;

    public function __construct()
    {
        $this->rendezvous = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection<int, Rendezvous>
     */
    public function getRendezvous(): Collection
    {
        return $this->rendezvous;
    }

    public function addRendezvou(Rendezvous $rendezvou): static
    {
        if (!$this->rendezvous->contains($rendezvou)) {
            $this->rendezvous->add($rendezvou);
            $rendezvou->setClient($this);
        }

        return $this;
    }

    public function removeRendezvou(Rendezvous $rendezvou): static
    {
        if ($this->rendezvous->removeElement($rendezvou)) {
            // set the owning side to null (unless already changed)
            if ($rendezvou->getClient() === $this) {
                $rendezvou->setClient(null);
            }
        }

        return $this;
    }
}
