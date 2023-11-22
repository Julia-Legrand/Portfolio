<?php

namespace App\Entity;

use App\Repository\CareerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CareerRepository::class)]
class Career
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $careerTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $careerCompany = null;

    #[ORM\Column(length: 100)]
    private ?string $careerCity = null;

    #[ORM\Column(type: "integer", name: "start_date", nullable: true)]
    private ?int $startDate = null;

    #[ORM\Column(type: "integer", name: "end_date", nullable: true)]
    private ?int $endDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCareerTitle(): ?string
    {
        return $this->careerTitle;
    }

    public function setCareerTitle(string $careerTitle): static
    {
        $this->careerTitle = $careerTitle;

        return $this;
    }

    public function getCareerCompany(): ?string
    {
        return $this->careerCompany;
    }

    public function setCareerCompany(string $careerCompany): static
    {
        $this->careerCompany = $careerCompany;

        return $this;
    }

    public function getCareerCity(): ?string
    {
        return $this->careerCity;
    }

    public function setCareerCity(string $careerCity): static
    {
        $this->careerCity = $careerCity;

        return $this;
    }

    public function getStartDate(): ?int
    {
        return $this->startDate;
    }

    public function setStartDate(?int $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?int
    {
        return $this->endDate;
    }

    public function setEndDate(?int $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }
}
