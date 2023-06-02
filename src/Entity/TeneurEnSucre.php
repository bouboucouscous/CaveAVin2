<?php

namespace App\Entity;

use App\Repository\TeneurEnSucreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeneurEnSucreRepository::class)]
class TeneurEnSucre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $gout = null;

    #[ORM\OneToMany(mappedBy: 'TeneurEnSucre', targetEntity: Vin::class)]
    private Collection $vins;

    public function __construct()
    {
        $this->vins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGout(): ?string
    {
        return $this->gout;
    }

    public function setGout(string $gout): self
    {
        $this->gout = $gout;

        return $this;
    }

    /**
     * @return Collection<int, Vin>
     */
    public function getVins(): Collection
    {
        return $this->vins;
    }

    public function addVin(Vin $vin): self
    {
        if (!$this->vins->contains($vin)) {
            $this->vins->add($vin);
            $vin->setTeneurEnSucre($this);
        }

        return $this;
    }

    public function removeVin(Vin $vin): self
    {
        if ($this->vins->removeElement($vin)) {
            // set the owning side to null (unless already changed)
            if ($vin->getTeneurOEnSucre() === $this) {
                $vin->setTeneurEnSucre(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->gout;
    }
}
