<?php

namespace App\Entity;

use App\Repository\CompositionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompositionRepository::class)]
class Composition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Ingredient::class, inversedBy: 'compositions')]
    #[ORM\JoinColumn(nullable: false)]
    private $ingredient;

    #[ORM\ManyToOne(targetEntity: recette::class, inversedBy: 'compositions')]
    #[ORM\JoinColumn(nullable: false)]
    private $recette;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getRecette(): ?recette
    {
        return $this->recette;
    }

    public function setRecette(?recette $recette): self
    {
        $this->recette = $recette;

        return $this;
    }
}
