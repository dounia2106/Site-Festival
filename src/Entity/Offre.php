<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
class Offre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'offres')]
    private ?Etablissement $etablissement = null;

    #[ORM\ManyToOne(inversedBy: 'offres')]
    private ?TypeChambre $typeschambres = null;

    #[ORM\Column]
    private ?int $nombreChambres = null;

    #[ORM\OneToMany(mappedBy: 'offre', targetEntity: Attributions::class)]
    private Collection $attributions;

    public function __construct()
    {
        $this->attributions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    public function getTypeschambres(): ?TypeChambre
    {
        return $this->typeschambres;
    }

    public function setTypeschambres(?TypeChambre $typeschambres): self
    {
        $this->typeschambres = $typeschambres;

        return $this;
    }

    public function getNombreChambres(): ?int
    {
        return $this->nombreChambres;
    }

    public function setNombreChambres(int $nombreChambres): self
    {
        $this->nombreChambres = $nombreChambres;

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
            $attribution->setOffre($this);
        }

        return $this;
    }

    public function removeAttribution(Attributions $attribution): self
    {
        if ($this->attributions->removeElement($attribution)) {
            // set the owning side to null (unless already changed)
            if ($attribution->getOffre() === $this) {
                $attribution->setOffre(null);
            }
        }

        return $this;
    }

    public function __toString():string{

        return $this->etablissement->getNom()." ". $this->nombreChambres." ".$this->typeschambres->getLibelle();
    }
   
}
