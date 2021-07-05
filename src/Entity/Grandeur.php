<?php

namespace App\Entity;

use App\Repository\GrandeurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GrandeurRepository::class)
 */
class Grandeur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $gra_unite;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $gra_nom;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $gra_archive;

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
}
