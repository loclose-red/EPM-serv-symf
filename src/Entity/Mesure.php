<?php

namespace App\Entity;

use App\Repository\MesureRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get","post"},
 *     itemOperations={"get"},
 * )
 * @ORM\Entity(repositoryClass=MesureRepository::class)
 */
class Mesure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $mes_valeur_1;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $mes_valeur_2;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $mes_valeur_3;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $mes_valeur_4;

    /**
     * @ORM\Column(type="datetime")
     */
    private $mes_date;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $mes_archive;

    /**
     * @ORM\ManyToOne(targetEntity=Grandeur::class, inversedBy="mesures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $grandeur;

    /**
     * @ORM\ManyToOne(targetEntity=Capteur::class, inversedBy="mesures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $capteur;

    /**
     * @ORM\ManyToOne(targetEntity=PtMesure::class, inversedBy="mesures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ptmesure;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $mes_obj_json = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMesValeur1(): ?string
    {
        return $this->mes_valeur_1;
    }

    public function setMesValeur1(string $mes_valeur_1): self
    {
        $this->mes_valeur_1 = $mes_valeur_1;

        return $this;
    }

    public function getMesValeur2(): ?string
    {
        return $this->mes_valeur_2;
    }

    public function setMesValeur2(?string $mes_valeur_2): self
    {
        $this->mes_valeur_2 = $mes_valeur_2;

        return $this;
    }

    public function getMesValeur3(): ?string
    {
        return $this->mes_valeur_3;
    }

    public function setMesValeur3(?string $mes_valeur_3): self
    {
        $this->mes_valeur_3 = $mes_valeur_3;

        return $this;
    }

    public function getMesValeur4(): ?string
    {
        return $this->mes_valeur_4;
    }

    public function setMesValeur4(?string $mes_valeur_4): self
    {
        $this->mes_valeur_4 = $mes_valeur_4;

        return $this;
    }

    public function getMesDate(): ?\DateTimeInterface
    {
        return $this->mes_date;
    }

    public function setMesDate(\DateTimeInterface $mes_date): self
    {
        $this->mes_date = $mes_date;

        return $this;
    }

    public function getMesArchive(): ?bool
    {
        return $this->mes_archive;
    }

    public function setMesArchive(?bool $mes_archive): self
    {
        $this->mes_archive = $mes_archive;

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

    public function getCapteur(): ?Capteur
    {
        return $this->capteur;
    }

    public function setCapteur(?Capteur $capteur): self
    {
        $this->capteur = $capteur;

        return $this;
    }

    public function getPtmesure(): ?PtMesure
    {
        return $this->ptmesure;
    }

    public function setPtmesure(?PtMesure $ptmesure): self
    {
        $this->ptmesure = $ptmesure;

        return $this;
    }

    public function getMesObjJson(): ?array
    {
        return $this->mes_obj_json;
    }

    public function setMesObjJson(?array $mes_obj_json): self
    {
        $this->mes_obj_json = $mes_obj_json;

        return $this;
    }
}
