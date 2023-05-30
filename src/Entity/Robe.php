<?php

namespace App\Entity;

use App\Repository\RobeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RobeRepository::class)]
class Robe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $couleurRobe = null;

    #[ORM\OneToMany(mappedBy: 'robe', targetEntity: Vin::class)]
    private Collection $vins;

    public function __construct()
    {
        $this->vins = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCouleurRobe(): ?string
    {
        return $this->couleurRobe;
    }

    public function setCouleurRobe(string $couleurRobe): self
    {
        $this->couleurRobe = $couleurRobe;

        return $this;
    }

    /**
     * @return Collection<int, Vin>
     */
    public function getVins(): Collection
    {
        return $this->vins;
    }

    public function addRobe(Vin $vin): self
    {
        if (!$this->vins->contains($vin)) {
            $this->vins->add($vin);
            $vin->setRobe($this);
        }

        return $this;
    }

    public function removeRobe(Vin $vin): self
    {
        if ($this->Robe->removeElement($vin)) {
            // set the owning side to null (unless already changed)
            if ($vin->getRobe() === $this) {
                $vin->setRobe(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->couleurRobe;
    }
}
