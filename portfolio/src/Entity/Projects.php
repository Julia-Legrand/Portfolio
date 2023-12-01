<?php

namespace App\Entity;

use App\Entity\Skills;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProjectsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ProjectsRepository::class)]
class Projects
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $projectPicture = null;

    #[ORM\Column(length: 100)]
    private ?string $projectTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $projectText = null;

    #[ORM\ManyToMany(targetEntity: Skills::class, inversedBy: 'projects')]
    private Collection $skills;

    #[ORM\OneToMany(mappedBy: 'projects', targetEntity: Pictures::class)]
    private Collection $pictures;

    #[ORM\Column(length: 100)]
    private ?string $github = null;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
        $this->pictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjectPicture(): ?string
    {
        return $this->projectPicture;
    }

    public function setProjectPicture(string $projectPicture): static
    {
        $this->projectPicture = $projectPicture;

        return $this;
    }

    public function getProjectTitle(): ?string
    {
        return $this->projectTitle;
    }

    public function setProjectTitle(string $projectTitle): static
    {
        $this->projectTitle = $projectTitle;

        return $this;
    }

    public function getProjectText(): ?string
    {
        return $this->projectText;
    }

    public function setProjectText(string $projectText): static
    {
        $this->projectText = $projectText;

        return $this;
    }

    /**
     * @return Collection<int, Skills>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skills $skill): static
    {
        if (!$this->skills->contains($skill)) {
            $this->skills->add($skill);
        }

        return $this;
    }

    public function removeSkill(Skills $skill): static
    {
        $this->skills->removeElement($skill);

        return $this;
    }

    /**
     * @return Collection<int, Pictures>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Pictures $picture): static
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
            $picture->setProjects($this);
        }

        return $this;
    }

    public function removePicture(Pictures $picture): static
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getProjects() === $this) {
                $picture->setProjects(null);
            }
        }

        return $this;
    }

    public function getGithub(): ?string
    {
        return $this->github;
    }

    public function setGithub(string $github): static
    {
        $this->github = $github;

        return $this;
    }
}
