<?php

namespace App\Entity;

use App\Repository\TechniqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TechniqueRepository::class)]
class Technique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $category = null;

    #[ORM\Column(length: 255)]
    private ?string $video = null;

    /**
     * @var Collection<int, Belt>
     */
    #[ORM\ManyToMany(targetEntity: Belt::class, inversedBy: 'techniques')]
    private Collection $belts;

    public function __construct()
    {
        $this->belts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?int
    {
        return $this->category;
    }

    public function setCategory(int $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(string $video): static
    {
        $this->video = $video;

        return $this;
    }

    /**
     * @return Collection<int, Belt>
     */
    public function getBelts(): Collection
    {
        return $this->belts;
    }

    public function addBelt(Belt $belt): static
    {
        if (!$this->belts->contains($belt)) {
            $this->belts->add($belt);
        }

        return $this;
    }

    public function removeBelt(Belt $belt): static
    {
        $this->belts->removeElement($belt);

        return $this;
    }
}
