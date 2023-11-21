<?php

namespace App\Entity;

use App\Repository\AboutRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AboutRepository::class)]
class About
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $aboutText = null;

    #[ORM\Column(length: 255)]
    private ?string $aboutPicture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAboutText(): ?string
    {
        return $this->aboutText;
    }

    public function setAboutText(string $aboutText): static
    {
        $this->aboutText = $aboutText;

        return $this;
    }

    public function getAboutPicture(): ?string
    {
        return $this->aboutPicture;
    }

    public function setAboutPicture(string $aboutPicture): static
    {
        $this->aboutPicture = $aboutPicture;

        return $this;
    }
}
