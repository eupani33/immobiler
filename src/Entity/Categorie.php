<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $classe;

    /**
     * @ORM\OneToMany(targetEntity=Ecriture::class, mappedBy="categorie")
     */
    private $ecriture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categorie;

    public function __construct()
    {
        $this->ecriture = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClasse(): ?string
    {
        return $this->classe;
    }

    public function setClasse(string $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return Collection|Ecriture[]
     */
    public function getEcriture(): Collection
    {
        return $this->ecriture;
    }

    public function addEcriture(Ecriture $ecriture): self
    {
        if (!$this->ecriture->contains($ecriture)) {
            $this->ecriture[] = $ecriture;
            $ecriture->setCategorie($this);
        }

        return $this;
    }

    public function removeEcriture(Ecriture $ecriture): self
    {
        if ($this->ecriture->removeElement($ecriture)) {
            // set the owning side to null (unless already changed)
            if ($ecriture->getCategorie() === $this) {
                $ecriture->setCategorie(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
