<?php

namespace App\Entity;

use App\Repository\CapteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CapteurRepository::class)
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     normalizationContext={"groups"={"capteur:read"}},
 *     denormalizationContext={"groups"={"capteur:write"}},
 * )
 */
class Capteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"capteur:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"capteur:read"})
     */
    private $cap_marque;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"capteur:read"})
     */
    private $cap_modele;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"capteur:read"})
     */
    private $cap_serie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cap_information;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"capteur:read"})
     */
    private $cap_archive;

    /**
     * @ORM\ManyToOne(targetEntity=Grandeur::class, inversedBy="capteurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $grandeur;

    /**
     * @ORM\OneToMany(targetEntity=Mesure::class, mappedBy="capteur")
     */
    private $mesures;

    /**
     * @ORM\OneToMany(targetEntity=PtMesure::class, mappedBy="capteur")
     * @Groups({"capteur:read"})
     */
    private $ptMesures;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="capteurs")
     * @Groups({"capteur:read"})
     */
    private $site;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Groups({"capteur:read"})
     */
    private $cap_macadress;

    public function __construct()
    {
        $this->mesures = new ArrayCollection();
        $this->ptMesures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapMarque(): ?string
    {
        return $this->cap_marque;
    }

    public function setCapMarque(string $cap_marque): self
    {
        $this->cap_marque = $cap_marque;

        return $this;
    }

    public function getCapModele(): ?string
    {
        return $this->cap_modele;
    }

    public function setCapModele(string $cap_modele): self
    {
        $this->cap_modele = $cap_modele;

        return $this;
    }

    public function getCapSerie(): ?string
    {
        return $this->cap_serie;
    }

    public function setCapSerie(string $cap_serie): self
    {
        $this->cap_serie = $cap_serie;

        return $this;
    }

    public function getCapInformation(): ?string
    {
        return $this->cap_information;
    }

    public function setCapInformation(?string $cap_information): self
    {
        $this->cap_information = $cap_information;

        return $this;
    }

    public function getCapArchive(): ?bool
    {
        return $this->cap_archive;
    }

    public function setCapArchive(?bool $cap_archive): self
    {
        $this->cap_archive = $cap_archive;

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
            $mesure->setCapteur($this);
        }

        return $this;
    }

    public function removeMesure(Mesure $mesure): self
    {
        if ($this->mesures->removeElement($mesure)) {
            // set the owning side to null (unless already changed)
            if ($mesure->getCapteur() === $this) {
                $mesure->setCapteur(null);
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
            $ptMesure->setCapteur($this);
        }

        return $this;
    }

    public function removePtMesure(PtMesure $ptMesure): self
    {
        if ($this->ptMesures->removeElement($ptMesure)) {
            // set the owning side to null (unless already changed)
            if ($ptMesure->getCapteur() === $this) {
                $ptMesure->setCapteur(null);
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
    public function __toString()
    {
        return $this->getCapMarque() . " : " . $this->getCapSerie();
    }

    public function getCapMacadress(): ?string
    {
        return $this->cap_macadress;
    }

    public function setCapMacadress(?string $cap_macadress): self
    {
        $this->cap_macadress = $cap_macadress;

        return $this;
    }
}
