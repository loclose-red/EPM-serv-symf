<?php

namespace App\Entity;

use App\Repository\CapteurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CapteurRepository::class)
 */
class Capteur
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
    private $cap_marque;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $cap_modele;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $cap_serie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cap_information;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $cap_archive;

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
}
