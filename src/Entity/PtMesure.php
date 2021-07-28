<?php

namespace App\Entity;

use App\Repository\PtMesureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PtMesureRepository::class)
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     normalizationContext={"groups"={"ptMesure:read"}},
 *     denormalizationContext={"groups"={"ptMesure:write"}},
 * )
 */
class PtMesure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"ptMesure:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"ptMesure:read"})
     */
    private $pt_mes_nom;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"ptMesure:read"})
     */
    private $pt_mes_position;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"ptMesure:read"})
     */
    private $pt_mes_archive;

    /**
     * @ORM\ManyToOne(targetEntity=Grandeur::class, inversedBy="ptMesures")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"ptMesure:read"})
     */
    private $grandeur;

    /**
     * @ORM\OneToMany(targetEntity=Mesure::class, mappedBy="ptmesure")
     */
    private $mesures;

    /**
     * @ORM\ManyToOne(targetEntity=Capteur::class, inversedBy="ptMesures")
     * @Groups({"ptMesure:read"})
     */
    private $capteur;

    /**
     * @ORM\ManyToOne(targetEntity=Equipement::class, inversedBy="ptMesures")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"ptMesure:read"})
     */
    private $equipement;

    public function __construct()
    {
        $this->mesures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPtMesNom(): ?string
    {
        return $this->pt_mes_nom;
    }

    public function setPtMesNom(string $pt_mes_nom): self
    {
        $this->pt_mes_nom = $pt_mes_nom;

        return $this;
    }

    public function getPtMesPosition(): ?string
    {
        return $this->pt_mes_position;
    }

    public function setPtMesPosition(?string $pt_mes_position): self
    {
        $this->pt_mes_position = $pt_mes_position;

        return $this;
    }

    public function getPtMesArchive(): ?bool
    {
        return $this->pt_mes_archive;
    }

    public function setPtMesArchive(?bool $pt_mes_archive): self
    {
        $this->pt_mes_archive = $pt_mes_archive;

        return $this;
    }

    public function getGrandeur(): ?Grandeur
    {
        return $this->grandeur;
    }

    public function setGrandeur(?Grandeur $grandeur): self
    {
        $this->grandeur = $grandeur;

        return $this;
    }

    /**
     * @return Collection|Mesure[]
     */
    public function getMesures(): Collection
    {
        return $this->mesures;
    }

    public function addMesure(Mesure $mesure): self
    {
        if (!$this->mesures->contains($mesure)) {
            $this->mesures[] = $mesure;
            $mesure->setPtmesure($this);
        }

        return $this;
    }

    public function removeMesure(Mesure $mesure): self
    {
        if ($this->mesures->removeElement($mesure)) {
            // set the owning side to null (unless already changed)
            if ($mesure->getPtmesure() === $this) {
                $mesure->setPtmesure(null);
            }
        }

        return $this;
    }

    public function getCapteur(): ?Capteur
    {
        return $this->capteur;
    }

    public function setCapteur(?Capteur $capteur): self
    {
        $this->capteur = $capteur;

        return $this;
    }

    public function getEquipement(): ?Equipement
    {
        return $this->equipement;
    }

    public function setEquipement(?Equipement $equipement): self
    {
        $this->equipement = $equipement;

        return $this;
    }
}
