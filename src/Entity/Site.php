<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 */
class Site
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
    private $sit_raison_sociale;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $sit_ville;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $sit_c_postal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sit_adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sit_information;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $sit_archive;

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
}
