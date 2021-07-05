<?php

namespace App\Entity;

use App\Repository\PtMesureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PtMesureRepository::class)
 */
class PtMesure
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
    private $pt_mes_nom;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $pt_mes_position;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $pt_mes_archive;

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
}
