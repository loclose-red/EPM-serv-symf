<?php

namespace App\Entity;

use App\Repository\GrandeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GrandeurRepository::class)
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     normalizationContext={"groups"={"grandeur:read"}},
 *     denormalizationContext={"groups"={"grandeur:write"}},
 * )
 */
class Grandeur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"grandeur:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"grandeur:read"})
     */
    private $gra_unite;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({"grandeur:read"})
     */
    private $gra_nom;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"grandeur:read"})
     */
    private $gra_archive;

    /**
     * @ORM\OneToMany(targetEntity=Capteur::class, mappedBy="grandeur")
     */
    private $capteurs;

    /**
     * @ORM\OneToMany(targetEntity=Mesure::class, mappedBy="grandeur")
     */
    private $mesures;

    /**
     * @ORM\OneToMany(targetEntity=PtMesure::class, mappedBy="grandeur")
     */
    private $ptMesures;

    public function __construct()
    {
        $this->capteurs = new ArrayCollection();
        $this->mesures = new ArrayCollection();
        $this->ptMesures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGraUnite(): ?string
    {
        return $this->gra_unite;
    }

    public function setGraUnite(string $gra_unite): self
    {
        $this->gra_unite = $gra_unite;

        return $this;
    }

    public function getGraNom(): ?string
    {
        return $this->gra_nom;
    }

    public function setGraNom(string $gra_nom): self
    {
        $this->gra_nom = $gra_nom;

        return $this;
    }

    public function getGraArchive(): ?bool
    {
        return $this->gra_archive;
    }

    public function setGraArchive(?bool $gra_archive): self
    {
        $this->gra_archive = $gra_archive;

        return $this;
    }

    /**
     * @return Collection|Capteur[]
     */
    public function getCapteurs(): Collection
    {
        return $this->capteurs;
    }

    public function addCapteur(Capteur $capteur): self
    {
        if (!$this->capteurs->contains($capteur)) {
            $this->capteurs[] = $capteur;
            $capteur->setGrandeur($this);
        }

        return $this;
    }

    public function removeCapteur(Capteur $capteur): self
    {
        if ($this->capteurs->removeElement($capteur)) {
            // set the owning side to null (unless already changed)
            if ($capteur->getGrandeur() === $this) {
                $capteur->setGrandeur(null);
            }
        }

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
            $mesure->setGrandeur($this);
        }

        return $this;
    }

    public function removeMesure(Mesure $mesure): self
    {
        if ($this->mesures->removeElement($mesure)) {
            // set the owning side to null (unless already changed)
            if ($mesure->getGrandeur() === $this) {
                $mesure->setGrandeur(null);
            }
        }

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
            $ptMesure->setGrandeur($this);
        }

        return $this;
    }

    public function removePtMesure(PtMesure $ptMesure): self
    {
        if ($this->ptMesures->removeElement($ptMesure)) {
            // set the owning side to null (unless already changed)
            if ($ptMesure->getGrandeur() === $this) {
                $ptMesure->setGrandeur(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getGraUnite();
    }
}
