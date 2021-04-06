<?php

namespace App\Entity;

use App\Repository\ChargeRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChargeRepository::class)
 */
class Charge
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
    private $libelle;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="date")
     */
    private $date_paiement;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $acompte;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_acompte;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $recurrente;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $periodicite;

    /**
     * @ORM\ManyToOne(targetEntity=Fournisseur::class, inversedBy="charges")
     */
    private $fournisseur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $statut;

    public function __construct()
    {
        $this->recurrente = false;
        $this->statut = false;
        $this->date_paiement = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getMontant(): ?float
    {

        return $this->montant;
    }



    public function getMontantFormat(): string
    {
        return number_format($this->montant, 2, ',', ' ');
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDatePaiement(): ?\DateTimeInterface
    {
        return $this->date_paiement;
    }

    public function setDatePaiement(\DateTimeInterface $date_paiement): self
    {
        $this->date_paiement = $date_paiement;

        return $this;
    }

    public function getAcompte(): ?float
    {
        return $this->acompte;
    }

    public function setAcompte(?float $acompte): self
    {
        $this->acompte = $acompte;

        return $this;
    }

    public function getDateAcompte(): ?\DateTimeInterface
    {
        return $this->date_acompte;
    }

    public function setDateAcompte(?\DateTimeInterface $date_acompte): self
    {
        $this->date_acompte = $date_acompte;

        return $this;
    }

    public function getRecurrente(): ?bool
    {
        return $this->recurrente;
    }

    public function setRecurrente(?bool $recurrente): self
    {
        $this->recurrente = $recurrente;

        return $this;
    }

    public function getPeriodicite(): ?string
    {
        return $this->periodicite;
    }

    public function setPeriodicite(?string $periodicite): self
    {
        $this->periodicite = $periodicite;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }
    // public function __toString()
    // {
    //      return '' . $this->id;
    // }

    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): self
    {
        $this->statut = $statut;

        return $this;
    }
}
