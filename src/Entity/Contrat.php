<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 */
class Contrat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_entree;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_sortie;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_etat_lieux;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $loyer;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $charges;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $caution;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $taxes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $eau_entree;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $eau_sortie;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default":true})
     */
    private $actif;

    /**
     * @ORM\ManyToOne(targetEntity=Local::class, inversedBy="contrats")
     */
    private $local;

    /**
     * @ORM\OneToOne(targetEntity=Locataire::class, inversedBy="contrat", cascade={"persist", "remove"})
     */
    private $locataire;

    /**
     * @ORM\OneToMany(targetEntity=Loyer::class, mappedBy="contrat", orphanRemoval=true)
     */
    private $loyers;

    public function __construct()
    {
        $this->loyers = new ArrayCollection();
        $this->actif = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->date_entree;
    }

    public function setDateEntree(\DateTimeInterface $date_entree): self
    {
        $this->date_entree = $date_entree;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->date_sortie;
    }

    public function setDateSortie(?\DateTimeInterface $date_sortie): self
    {
        $this->date_sortie = $date_sortie;

        return $this;
    }

    public function getDateEtatLieux(): ?\DateTimeInterface
    {
        return $this->date_etat_lieux;
    }

    public function setDateEtatLieux(?\DateTimeInterface $date_etat_lieux): self
    {
        $this->date_etat_lieux = $date_etat_lieux;

        return $this;
    }

    public function getLoyer(): ?float
    {
        return $this->loyer;
    }

    public function setLoyer(?float $loyer): self
    {
        $this->loyer = $loyer;

        return $this;
    }

    public function getCharges(): ?float
    {
        return $this->charges;
    }

    public function setCharges(?float $charges): self
    {
        $this->charges = $charges;

        return $this;
    }

    public function getCaution(): ?float
    {
        return $this->caution;
    }

    public function setCaution(?float $caution): self
    {
        $this->caution = $caution;

        return $this;
    }

    public function getTaxes(): ?float
    {
        return $this->taxes;
    }

    public function setTaxes(?float $taxes): self
    {
        $this->taxes = $taxes;

        return $this;
    }

    public function getEauEntree(): ?int
    {
        return $this->eau_entree;
    }

    public function setEauEntree(?int $eau_entree): self
    {
        $this->eau_entree = $eau_entree;

        return $this;
    }

    public function getEauSortie(): ?int
    {
        return $this->eau_sortie;
    }

    public function setEauSortie(?int $eau_sortie): self
    {
        $this->eau_sortie = $eau_sortie;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(?bool $actif): self
    {

        $this->actif = $actif;

        return $this;
    }

    public function getLocal(): ?Local
    {
        return $this->local;
    }

    public function setLocal(?Local $local): self
    {
        $this->local = $local;

        return $this;
    }

    public function getLocataire(): ?Locataire
    {
        return $this->locataire;
    }

    public function setLocataire(?Locataire $locataire): self
    {
        $this->locataire = $locataire;

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
            $loyer->setContrat($this);
        }

        return $this;
    }

    public function removeLoyer(Loyer $loyer): self
    {
        if ($this->loyers->removeElement($loyer)) {
            // set the owning side to null (unless already changed)
            if ($loyer->getContrat() === $this) {
                $loyer->setContrat(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return '' . $this->id;
    }
}
