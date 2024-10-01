<?php

namespace App\Entity;

use App\Repository\ExamRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExamRepository::class)]
class Exam
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Belt $name = null;

    #[ORM\ManyToOne(inversedBy: 'exams')]
    private ?User $examTaker = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getName(): ?Belt
    {
        return $this->name;
    }

    public function setName(?Belt $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getExamTaker(): ?User
    {
        return $this->examTaker;
    }

    public function setExamTaker(?User $examTaker): static
    {
        $this->examTaker = $examTaker;

        return $this;
    }
}
