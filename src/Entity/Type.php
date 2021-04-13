<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
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
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Loyer::class, mappedBy="types")
     */
    private $loyers;

    /**
     * @ORM\OneToMany(targetEntity=Charge::class, mappedBy="type")
     */
    private $charges;

    public function __construct()
    {
        $this->loyers = new ArrayCollection();
        $this->charges = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Loyer[]
     */
    public function getLoyers(): Collection
    {
        return $this->loyers;
    }

    public function addLoyer(Loyer $loyer): self
    {
        if (!$this->loyers->contains($loyer)) {
            $this->loyers[] = $loyer;
            $loyer->setTypes($this);
        }

        return $this;
    }

    public function removeLoyer(Loyer $loyer): self
    {
        if ($this->loyers->removeElement($loyer)) {
            // set the owning side to null (unless already changed)
            if ($loyer->getTypes() === $this) {
                $loyer->setTypes(null);
            }
        }

        return $this;
    }
    function __toString()
    {
         return '' . $this->nom;
    }

    /**
     * @return Collection|Charge[]
     */
    public function getCharges(): Collection
    {
        return $this->charges;
    }

    public function addCharge(Charge $charge): self
    {
        if (!$this->charges->contains($charge)) {
            $this->charges[] = $charge;
            $charge->setType($this);
        }

        return $this;
    }

    public function removeCharge(Charge $charge): self
    {
        if ($this->charges->removeElement($charge)) {
            // set the owning side to null (unless already changed)
            if ($charge->getType() === $this) {
                $charge->setType(null);
            }
        }

        return $this;
    }
}
