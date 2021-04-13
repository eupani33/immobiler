<?php

namespace App\Entity;

use App\Repository\LocalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocalRepository::class)
 */
class Local
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
     * @ORM\OneToMany(targetEntity=Ecriture::class, mappedBy="local")
     */
    private $ecriture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $compteurEdf;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $internet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $eau;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gaz;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $surface;

    /**
     * @ORM\OneToMany(targetEntity=Contrat::class, mappedBy="local")
     */
    private $contrats;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $teom;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $syndic;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix_eau;

    /**
     * @ORM\OneToMany(targetEntity=Charge::class, mappedBy="local")
     */
    private $charges;

    /**
     * @ORM\OneToMany(targetEntity=Loyer::class, mappedBy="local")
     */
    private $loyers;

    public function __construct()
    {
        $this->ecriture = new ArrayCollection();
        $this->contrats = new ArrayCollection();
        $this->charges = new ArrayCollection();
        $this->loyers = new ArrayCollection();
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
            $ecriture->setLocal($this);
        }

        return $this;
    }

    public function removeEcriture(Ecriture $ecriture): self
    {
        if ($this->ecriture->removeElement($ecriture)) {
            // set the owning side to null (unless already changed)
            if ($ecriture->getLocal() === $this) {
                $ecriture->setLocal(null);
            }
        }

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(?string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getCompteurEdf(): ?string
    {
        return $this->compteurEdf;
    }

    public function setCompteurEdf(?string $compteurEdf): self
    {
        $this->compteurEdf = $compteurEdf;

        return $this;
    }

    public function getInternet(): ?string
    {
        return $this->internet;
    }

    public function setInternet(?string $internet): self
    {
        $this->internet = $internet;

        return $this;
    }

    public function getEau(): ?string
    {
        return $this->eau;
    }

    public function setEau(?string $eau): self
    {
        $this->eau = $eau;

        return $this;
    }

    public function getGaz(): ?string
    {
        return $this->gaz;
    }

    public function setGaz(?string $gaz): self
    {
        $this->gaz = $gaz;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(?int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * @return Collection|Contrat[]
     */
    public function getContrats(): Collection
    {
        return $this->contrats;
    }

    public function addContrat(Contrat $contrat): self
    {
        if (!$this->contrats->contains($contrat)) {
            $this->contrats[] = $contrat;
            $contrat->setLocal($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrats->removeElement($contrat)) {
            // set the owning side to null (unless already changed)
            if ($contrat->getLocal() === $this) {
                $contrat->setLocal(null);
            }
        }

        return $this;
    }


    public function getteom(): ?float
    {
        return $this->teom;
    }

    public function setteom(?float $teom): self
    {
        $this->teom = $teom;

        return $this;
    }

    public function getSyndic(): ?float
    {
        return $this->syndic;
    }

    public function setSyndic(?float $syndic): self
    {
        $this->syndic = $syndic;

        return $this;
    }

    public function getPrixEau(): ?float
    {
        return $this->prix_eau;
    }

    public function setPrixEau(?float $prix_eau): self
    {
        $this->prix_eau = $prix_eau;

        return $this;
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
            $charge->setLocal($this);
        }

        return $this;
    }

    public function removeCharge(Charge $charge): self
    {
        if ($this->charges->removeElement($charge)) {
            // set the owning side to null (unless already changed)
            if ($charge->getLocal() === $this) {
                $charge->setLocal(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return '' . $this->nom;
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
            $loyer->setLocal($this);
        }

        return $this;
    }

    public function removeLoyer(Loyer $loyer): self
    {
        if ($this->loyers->removeElement($loyer)) {
            // set the owning side to null (unless already changed)
            if ($loyer->getLocal() === $this) {
                $loyer->setLocal(null);
            }
        }

        return $this;
    }
}
