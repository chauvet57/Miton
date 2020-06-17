<?php

namespace App\Entity;

use App\Repository\AlimentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlimentRepository::class)
 */
class Aliment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_aliment;

    /**
     * @ORM\ManyToMany(targetEntity=CategorieAliment::class, mappedBy="aliment")
     */
    private $categorieAliments;

    public function __construct()
    {
        $this->categorieAliments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAliment(): ?string
    {
        return $this->nom_aliment;
    }

    public function setNomAliment(string $nom_aliment): self
    {
        $this->nom_aliment = $nom_aliment;

        return $this;
    }

    /**
     * @return Collection|CategorieAliment[]
     */
    public function getCategorieAliments(): Collection
    {
        return $this->categorieAliments;
    }

    public function addCategorieAliment(CategorieAliment $categorieAliment): self
    {
        if (!$this->categorieAliments->contains($categorieAliment)) {
            $this->categorieAliments[] = $categorieAliment;
            $categorieAliment->addAliment($this);
        }

        return $this;
    }

    public function removeCategorieAliment(CategorieAliment $categorieAliment): self
    {
        if ($this->categorieAliments->contains($categorieAliment)) {
            $this->categorieAliments->removeElement($categorieAliment);
            $categorieAliment->removeAliment($this);
        }

        return $this;
    }
}
