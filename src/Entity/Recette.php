<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Commentaire;
/**
 * @ORM\Entity(repositoryClass=RecetteRepository::class)
 */
class Recette
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
    private $nom_recette;

    /**
     * @ORM\Column(type="boolean")
     */
    private $valide;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $temps;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_personne;

    /**
     * @ORM\Column(type="text")
     */
    private $image;

    /**
     * @ORM\Column(type="text")
     */
    private $images;

    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, mappedBy="recette")
     * @ORM\JoinTable(name="categorie_recette")
     */
    private $categories;

    /**
     * @ORM\Column(type="text")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredient;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="recettes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="recette", orphanRemoval=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity=Prix::class, inversedBy="recettes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=Difficulte::class, inversedBy="recettes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $difficulte;

    /**
     * @ORM\Column(type="text")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etape;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->commentaire = new ArrayCollection();
    }

    public function setId(int $id){

        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRecette(): ?string
    {
        return $this->nom_recette;
    }

    public function setNomRecette(string $nom_recette): self
    {
        $this->nom_recette = $nom_recette;

        return $this;
    }

    public function getValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(bool $valide): self
    {
        $this->valide = $valide;

        return $this;
    }

    public function getTemps()
    {
        return $this->temps;
    }

    public function setTemps($temps)
    {
        $this->temps = $temps;

        return $this;
    }

    public function getNombrePersonne(): ?int
    {
        return $this->nombre_personne;
    }

    public function setNombrePersonne(int $nombre_personne): self
    {
        $this->nombre_personne = $nombre_personne;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addRecette($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            $category->removeRecette($this);
        }

        return $this;
    }

    
    public function getIngredient()
    {
        return $this->ingredient;
    }

    public function setIngredient($ingredient)
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaire(): Collection
    {
        return $this->commentaire;
    }

    /**
     * @return $moyenne float
     */
    public function getMoyenneNote(): float {
        $moyenne = 0;
        $commentaire = $this->getCommentaire();
        foreach ($commentaire as $note) {

            $moyenne += $note->getNote()->getNomNote();
        }
        //boucle verif/0
        if($commentaire->count()){
            $moyenne = round($moyenne/$commentaire->count(),1);
        } return $moyenne;
    }

    public function setMoyenneNote($moyNote)
    {
        $this->moyNote = $moyNote;

        return $this;
    }



    public function getTotalNote(): int {
        
        $commentaire = $this->getCommentaire();

        return $commentaire->count();
    }

    public function setTotalNote($note)
    {
        $this->note = $note;

        return $this;
    }


    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire[] = $commentaire;
            $commentaire->setRecette($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaire->contains($commentaire)) {
            $this->commentaire->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getRecette() === $this) {
                $commentaire->setRecette(null);
            }
        }

        return $this;
    }

    public function getPrix(): ?Prix
    {
        return $this->prix;
    }

    public function setPrix(?Prix $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDifficulte(): ?Difficulte
    {
        return $this->difficulte;
    }

    public function setDifficulte(?Difficulte $difficulte): self
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    public function getEtape()
    {
        
        return $this->deserializer($this->etape);
    }

    public function setEtape($etape)
    {
        $this->etape = $etape;

        return $this;
    }

    public function twig_json_decode($json)
    {
        return json_decode($json, true);
    }

    public function deserializer($param){

        return unserialize($param);
    }

    public function getValue($param){


        return $param->getCategories()->getValues();
    }
}
