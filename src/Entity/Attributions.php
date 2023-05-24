<?php

namespace App\Entity;

use App\Repository\AttributionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttributionsRepository::class)]
class Attributions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombreschambres = null;

   
    #[ORM\ManyToOne(inversedBy: 'attributions')]
    private ?Groupes $groupes = null;

    #[ORM\ManyToOne(inversedBy: 'attributions')]
    private ?Offre $offre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreschambres(): ?int
    {
        return $this->nombreschambres;
    }

    public function setNombreschambres(int $nombreschambres): self
    {
        $this->nombreschambres = $nombreschambres;

        return $this;
    }


    public function getGroupes(): ?Groupes
    {
        return $this->groupes;
    }

    public function setGroupes(?Groupes $groupes): self
    {
        $this->groupes = $groupes;

        return $this;
    }

    public function getOffre(): ?Offre
    {
        return $this->offre;
    }

    public function setOffre(?Offre $offre): self
    {
        $this->offre = $offre;

        return $this;
    }
}
