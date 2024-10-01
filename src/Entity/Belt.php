<?php

namespace App\Entity;

use App\Repository\BeltRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BeltRepository::class)]
class Belt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    /**
     * @var Collection<int, Technique>
     */
    #[ORM\ManyToMany(targetEntity: Technique::class, mappedBy: 'belts')]
    private Collection $techniques;

    public function __construct()
    {
        $this->techniques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection<int, Technique>
     */
    public function getTechniques(): Collection
    {
        return $this->techniques;
    }

    public function addTechnique(Technique $technique): static
    {
        if (!$this->techniques->contains($technique)) {
            $this->techniques->add($technique);
            $technique->addBelt($this);
        }

        return $this;
    }

    public function removeTechnique(Technique $technique): static
    {
        if ($this->techniques->removeElement($technique)) {
            $technique->removeBelt($this);
        }

        return $this;
    }
}
