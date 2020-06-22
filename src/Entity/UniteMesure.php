<?php

namespace App\Entity;

use App\Repository\UniteMesureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UniteMesureRepository::class)
 */
class UniteMesure
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
    private $nom_unite;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUnite(): ?string
    {
        return $this->nom_unite;
    }

    public function setNomUnite(string $nom_unite): self
    {
        $this->nom_unite = $nom_unite;

        return $this;
    }

}
