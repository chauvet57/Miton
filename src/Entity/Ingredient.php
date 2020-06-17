<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
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
    private $nom_ingredient;

    /**
     * @ORM\Column(type="float")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=CategorieAliment::class, inversedBy="ingredients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie_aliment;

    /**
     * @ORM\ManyToMany(targetEntity=Recette::class, mappedBy="ingredient")
     */
    private $recettes;

    /**
     * @ORM\ManyToMany(targetEntity=UniteMesure::class, inversedBy="ingredients")
     */
    private $unite_mesure;

    public function __construct()
    {
        $this->recettes = new ArrayCollection();
        $this->unite_mesure = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomIngredient(): ?string
    {
        return $this->nom_ingredient;
    }

    public function setNomIngredient(string $nom_ingredient): self
    {
        $this->nom_ingredient = $nom_ingredient;

        return $this;
    }

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getCategorieAliment(): ?CategorieAliment
    {
        return $this->categorie_aliment;
    }

    public function setCategorieAliment(?CategorieAliment $categorie_aliment): self
    {
        $this->categorie_aliment = $categorie_aliment;

        return $this;
    }

    /**
     * @return Collection|Recette[]
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function addRecette(Recette $recette): self
    {
        if (!$this->recettes->contains($recette)) {
            $this->recettes[] = $recette;
            $recette->addIngredient($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): self
    {
        if ($this->recettes->contains($recette)) {
            $this->recettes->removeElement($recette);
            $recette->removeIngredient($this);
        }

        return $this;
    }

    /**
     * @return Collection|UniteMesure[]
     */
    public function getUniteMesure(): Collection
    {
        return $this->unite_mesure;
    }

    public function addUniteMesure(UniteMesure $uniteMesure): self
    {
        if (!$this->unite_mesure->contains($uniteMesure)) {
            $this->unite_mesure[] = $uniteMesure;
        }

        return $this;
    }

    public function removeUniteMesure(UniteMesure $uniteMesure): self
    {
        if ($this->unite_mesure->contains($uniteMesure)) {
            $this->unite_mesure->removeElement($uniteMesure);
        }

        return $this;
    }
}
