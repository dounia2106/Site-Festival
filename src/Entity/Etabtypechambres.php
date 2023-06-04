<?php

namespace App\Entity;

use App\Repository\EtabtypechambresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtabtypechambresRepository::class)]
class Etabtypechambres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'etabtypechambres')]
    private ?Etablissement $etablissement = null;

    #[ORM\ManyToOne(inversedBy: 'etabtypechambres')]
    private ?TypeChambre $typechambre = null;

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

    public function getTypechambre(): ?TypeChambre
    {
        return $this->typechambre;
    }

    public function setTypechambre(?TypeChambre $typechambre): self
    {
        $this->typechambre = $typechambre;

        return $this;
    }
}
