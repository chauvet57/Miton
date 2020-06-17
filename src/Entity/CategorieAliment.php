<?php

namespace App\Entity;

use App\Repository\CategorieAlimentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieAlimentRepository::class)
 */
class CategorieAliment
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
    private $nom_categorie_aliment;

    /**
     * @ORM\ManyToMany(targetEntity=Aliment::class, inversedBy="categorieAliments")
     */
    private $aliment;

    /**
     * @ORM\OneToMany(targetEntity=Ingredient::class, mappedBy="categorie_aliment")
     */
    private $ingredients;

    public function __construct()
    {
        $this->aliment = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorieAliment(): ?string
    {
        return $this->nom_categorie_aliment;
    }

    public function setNomCategorieAliment(string $nom_categorie_aliment): self
    {
        $this->nom_categorie_aliment = $nom_categorie_aliment;

        return $this;
    }

    /**
     * @return Collection|Aliment[]
     */
    public function getAliment(): Collection
    {
        return $this->aliment;
    }

    public function addAliment(Aliment $aliment): self
    {
        if (!$this->aliment->contains($aliment)) {
            $this->aliment[] = $aliment;
        }

        return $this;
    }

    public function removeAliment(Aliment $aliment): self
    {
        if ($this->aliment->contains($aliment)) {
            $this->aliment->removeElement($aliment);
        }

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
            $ingredient->setCategorieAliment($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredients->contains($ingredient)) {
            $this->ingredients->removeElement($ingredient);
            // set the owning side to null (unless already changed)
            if ($ingredient->getCategorieAliment() === $this) {
                $ingredient->setCategorieAliment(null);
            }
        }

        return $this;
    }
}
