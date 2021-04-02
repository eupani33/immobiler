<?php

namespace App\Entity;

use App\Repository\LoyerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LoyerRepository::class)
 */
class Loyer
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="float")
     */
    private $montant_tot;

    /**
     * @ORM\Column(type="float")
     */
    private $loyer;

    /**
     * @ORM\Column(type="float")
     */
    private $charge;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $caf;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="date")
     */
    private $periode_du;

    /**
     * @ORM\Column(type="date")
     */
    private $periode_au;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $paiement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $locataire_info;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $local_info;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $paie_1;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $paie_2;

    /**
     * @ORM\ManyToOne(targetEntity=Contrat::class, inversedBy="loyers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contrat;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_paiement;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMontantTot(): ?float
    {
        return $this->montant_tot;
    }

    public function setMontantTot(float $montant_tot): self
    {
        $this->montant_tot = $montant_tot;

        return $this;
    }

    public function getLoyer(): ?float
    {
        return $this->loyer;
    }

    public function setLoyer(float $loyer): self
    {
        $this->loyer = $loyer;

        return $this;
    }

    public function getCharge(): ?float
    {
        return $this->charge;
    }

    public function setCharge(float $charge): self
    {
        $this->charge = $charge;

        return $this;
    }

    public function getCaf(): ?float
    {
        return $this->caf;
    }

    public function setCaf(?float $caf): self
    {
        $this->caf = $caf;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPeriodeDu(): ?\DateTimeInterface
    {
        return $this->periode_du;
    }

    public function setPeriodeDu(\DateTimeInterface $periode_du): self
    {
        $this->periode_du = $periode_du;

        return $this;
    }

    public function getPeriodeAu(): ?\DateTimeInterface
    {
        return $this->periode_au;
    }

    public function setPeriodeAu(\DateTimeInterface $periode_au): self
    {
        $this->periode_au = $periode_au;

        return $this;
    }

    public function getPaiement(): ?float
    {
        return $this->paiement;
    }

    public function setPaiement(?float $paiement): self
    {
        $this->paiement = $paiement;

        return $this;
    }

    public function getLocataireInfo(): ?string
    {
        return $this->locataire_info;
    }

    public function setLocataireInfo(?string $locataire_info): self
    {
        $this->locataire_info = $locataire_info;

        return $this;
    }
    public function getLocalInfo(): ?string
    {
        return $this->local_info;
    }

    public function setLocalInfo(?string $local_info): self
    {
        $this->local_info = $local_info;

        return $this;
    }

    public function getPaie1(): ?float
    {
        return $this->paie_1;
    }

    public function setPaie1(?float $paie_1): self
    {
        $this->paie_1 = $paie_1;

        return $this;
    }

    public function getPaie2(): ?float
    {
        return $this->paie_2;
    }

    public function setPaie2(?float $paie_2): self
    {
        $this->paie_2 = $paie_2;

        return $this;
    }

    public function getContrat(): ?Contrat
    {
        return $this->contrat;
    }

    public function setContrat(?Contrat $contrat): self
    {
        $this->contrat = $contrat;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
