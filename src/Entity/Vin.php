<?php

namespace App\Entity;

use App\Repository\VinRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\component\HttpFoundation\File\File;


#[ORM\Entity(repositoryClass: VinRepository::class)]
class Vin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Annee = null;

    #[ORM\Column]
    private ?int $formatCl = null;

    
    private $image;

    #[ORM\ManyToOne(inversedBy: 'Robe')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Robe $robe = null;

    #[ORM\ManyToOne(inversedBy: 'vins')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TeneurEnSucre $TeneurEnSucre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->Annee;
    }

    public function setAnnee(\DateTimeInterface $Annee): self
    {
        $this->Annee = $Annee;

        return $this;
    }

    public function getFormatCl(): ?int
    {
        return $this->formatCl;
    }

    public function setFormatCl(int $formatCl): self
    {
        $this->formatCl = $formatCl;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(File $file =null)
    {
        $this->image = $file;
    }

    public function getRobe(): ?Robe
    {
        return $this->robe;
    }

    public function setRobe(?Robe $robe): self
    {
        $this->robe = $robe;

        return $this;
    }

    public function getTeneurEnSucre(): ?TeneurEnSucre
    {
        return $this->TeneurEnSucre;
    }

    public function setTeneurEnSucre(?TeneurEnSucre $TeneurEnSucre): self
    {
        $this->TeneurEnSucre = $TeneurEnSucre;

        return $this;
    }
}
