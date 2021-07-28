<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     normalizationContext={"groups"={"site:read"}},
 *     denormalizationContext={"groups"={"site:write"}},
 * )
 */
class Site
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"site:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"site:read"})
     */
    private $sit_raison_sociale;

    /**
     * @ORM\Column(type="string", length=120)
     * @Groups({"site:read"})
     */
    private $sit_ville;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"site:read"})
     */
    private $sit_c_postal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"site:read"})
     */
    private $sit_adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"site:read"})
     */
    private $sit_information;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"site:read"})
     */
    private $sit_archive;

    /**
     * @ORM\OneToMany(targetEntity=Equipement::class, mappedBy="site")
     * @Groups({"site:read"})
     */
    private $equipements;

    /**
     * @ORM\OneToMany(targetEntity=Capteur::class, mappedBy="site")
     */
    private $capteurs;

    /**
     * @ORM\ManyToMany(targetEntity=Utilisateur::class, mappedBy="site")
     */
    private $utilisateurs;


    public function __construct()
    {
        $this->equipements = new ArrayCollection();
        $this->capteurs = new ArrayCollection();
        $this->utilisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSitRaisonSociale(): ?string
    {
        return $this->sit_raison_sociale;
    }

    public function setSitRaisonSociale(string $sit_raison_sociale): self
    {
        $this->sit_raison_sociale = $sit_raison_sociale;

        return $this;
    }

    public function getSitVille(): ?string
    {
        return $this->sit_ville;
    }

    public function setSitVille(string $sit_ville): self
    {
        $this->sit_ville = $sit_ville;

        return $this;
    }

    public function getSitCPostal(): ?string
    {
        return $this->sit_c_postal;
    }

    public function setSitCPostal(string $sit_c_postal): self
    {
        $this->sit_c_postal = $sit_c_postal;

        return $this;
    }

    public function getSitAdresse(): ?string
    {
        return $this->sit_adresse;
    }

    public function setSitAdresse(?string $sit_adresse): self
    {
        $this->sit_adresse = $sit_adresse;

        return $this;
    }

    public function getSitInformation(): ?string
    {
        return $this->sit_information;
    }

    public function setSitInformation(?string $sit_information): self
    {
        $this->sit_information = $sit_information;

        return $this;
    }

    public function getSitArchive(): ?bool
    {
        return $this->sit_archive;
    }

    public function setSitArchive(?bool $sit_archive): self
    {
        $this->sit_archive = $sit_archive;

        return $this;
    }

    /**
     * @return Collection|Equipement[]
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): self
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements[] = $equipement;
            $equipement->setSite($this);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): self
    {
        if ($this->equipements->removeElement($equipement)) {
            // set the owning side to null (unless already changed)
            if ($equipement->getSite() === $this) {
                $equipement->setSite(null);
            }
        }

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
            $capteur->setSite($this);
        }

        return $this;
    }

    public function removeCapteur(Capteur $capteur): self
    {
        if ($this->capteurs->removeElement($capteur)) {
            // set the owning side to null (unless already changed)
            if ($capteur->getSite() === $this) {
                $capteur->setSite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs[] = $utilisateur;
            $utilisateur->addSite($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): self
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            $utilisateur->removeSite($this);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getSitRaisonSociale();
    }
}
