<?php

namespace App\Entity;

use App\Repository\GroupesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupesRepository::class)]
class Groupes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $adressePostal = null;

    #[ORM\Column(length: 50)]
    private ?string $nbpersonnes = null;

    #[ORM\Column(length: 590)]
    private ?string $nompays = null;

   

    #[ORM\ManyToOne(inversedBy: 'groupes')]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'groupes', targetEntity: Attributions::class)]
    private Collection $attributions;

    public function __construct()
    {
        $this->attributions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdressePostal(): ?string
    {
        return $this->adressePostal;
    }

    public function setAdressePostal(string $adressePostal): self
    {
        $this->adressePostal = $adressePostal;

        return $this;
    }

    public function getNbpersonnes(): ?string
    {
        return $this->nbpersonnes;
    }

    public function setNbpersonnes(string $nbpersonnes): self
    {
        $this->nbpersonnes = $nbpersonnes;

        return $this;
    }

    public function getNompays(): ?string
    {
        return $this->nompays;
    }

    public function setNompays(string $nompays): self
    {
        $this->nompays = $nompays;

        return $this;
    }

   

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Attributions>
     */
    public function getAttributions(): Collection
    {
        return $this->attributions;
    }

    public function addAttribution(Attributions $attribution): self
    {
        if (!$this->attributions->contains($attribution)) {
            $this->attributions->add($attribution);
            $attribution->setGroupes($this);
        }

        return $this;
    }

    public function removeAttribution(Attributions $attribution): self
    {
        if ($this->attributions->removeElement($attribution)) {
            // set the owning side to null (unless already changed)
            if ($attribution->getGroupes() === $this) {
                $attribution->setGroupes(null);
            }
        }

        return $this;
    }


    public function __toString():string{

        return $this->nom ;
    }
}
