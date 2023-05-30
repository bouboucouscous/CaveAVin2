<?php

namespace App\Entity;

use App\Repository\CaveRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CaveRepository::class)]
class Cave
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'cave', cascade: ['persist', 'remove'])]
    private ?Utilisateur $utilistaeur_id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Vin $id_vin = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $enter_date = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $exit_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilistaeurId(): ?Utilisateur
    {
        return $this->utilistaeur_id;
    }

    public function setUtilistaeurId(?Utilisateur $utilistaeur_id): self
    {
        $this->utilistaeur_id = $utilistaeur_id;

        return $this;
    }

    public function getIdVin(): ?Vin
    {
        return $this->id_vin;
    }

    public function setIdVin(Vin $id_vin): self
    {
        $this->id_vin = $id_vin;

        return $this;
    }

    public function getEnterDate(): ?\DateTimeImmutable
    {
        return $this->enter_date;
    }

    public function setEnterDate(\DateTimeImmutable $enter_date): self
    {
        $this->enter_date = $enter_date;

        return $this;
    }

    public function getExitDate(): ?\DateTimeImmutable
    {
        return $this->exit_date;
    }

    public function setExitDate(?\DateTimeImmutable $exit_date): self
    {
        $this->exit_date = $exit_date;

        return $this;
    }
}
