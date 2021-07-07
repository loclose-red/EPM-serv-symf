<?php

namespace App\Entity;

use App\Repository\EquipementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipementRepository::class)
 */
class Equipement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $equ_marque;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $equ_modele;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $equ_serie;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $equ_nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $equ_description;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $equ_photo_1;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $equ_archive;

    /**
     * @ORM\OneToMany(targetEntity=PtMesure::class, mappedBy="equipement")
     */
    private $ptMesures;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="equipements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $site;

    public function __construct()
    {
        $this->ptMesures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEquMarque(): ?string
    {
        return $this->equ_marque;
    }

    public function setEquMarque(string $equ_marque): self
    {
        $this->equ_marque = $equ_marque;

        return $this;
    }

    public function getEquModele(): ?string
    {
        return $this->equ_modele;
    }

    public function setEquModele(string $equ_modele): self
    {
        $this->equ_modele = $equ_modele;

        return $this;
    }

    public function getEquSerie(): ?string
    {
        return $this->equ_serie;
    }

    public function setEquSerie(string $equ_serie): self
    {
        $this->equ_serie = $equ_serie;

        return $this;
    }

    public function getEquNom(): ?string
    {
        return $this->equ_nom;
    }

    public function setEquNom(?string $equ_nom): self
    {
        $this->equ_nom = $equ_nom;

        return $this;
    }

    public function getEquDescription(): ?string
    {
        return $this->equ_description;
    }

    public function setEquDescription(?string $equ_description): self
    {
        $this->equ_description = $equ_description;

        return $this;
    }

    public function getEquPhoto1(): ?string
    {
        return $this->equ_photo_1;
    }

    public function setEquPhoto1(?string $equ_photo_1): self
    {
        $this->equ_photo_1 = $equ_photo_1;

        return $this;
    }

    public function getEquArchive(): ?bool
    {
        return $this->equ_archive;
    }

    public function setEquArchive(?bool $equ_archive): self
    {
        $this->equ_archive = $equ_archive;

        return $this;
    }

    /**
     * @return Collection|PtMesure[]
     */
    public function getPtMesures(): Collection
    {
        return $this->ptMesures;
    }

    public function addPtMesure(PtMesure $ptMesure): self
    {
        if (!$this->ptMesures->contains($ptMesure)) {
            $this->ptMesures[] = $ptMesure;
            $ptMesure->setEquipement($this);
        }

        return $this;
    }

    public function removePtMesure(PtMesure $ptMesure): self
    {
        if ($this->ptMesures->removeElement($ptMesure)) {
            // set the owning side to null (unless already changed)
            if ($ptMesure->getEquipement() === $this) {
                $ptMesure->setEquipement(null);
            }
        }

        return $this;
    }

    public function getSite(): ?Site
    {
        return $this->site;
    }

    public function setSite(?Site $site): self
    {
        $this->site = $site;

        return $this;
    }
}