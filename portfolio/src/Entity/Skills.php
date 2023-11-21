<?php

namespace App\Entity;

use App\Repository\SkillsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SkillsRepository::class)]
class Skills
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $skillPicture = null;

    #[ORM\Column(length: 100)]
    private ?string $skillTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $skillText = null;

    #[ORM\Column(length: 255)]
    private ?string $skillList = null;

    #[ORM\ManyToMany(targetEntity: Projects::class, mappedBy: 'skills')]
    private Collection $projects;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSkillPicture(): ?string
    {
        return $this->skillPicture;
    }

    public function setSkillPicture(string $skillPicture): static
    {
        $this->skillPicture = $skillPicture;

        return $this;
    }

    public function getSkillTitle(): ?string
    {
        return $this->skillTitle;
    }

    public function setSkillTitle(string $skillTitle): static
    {
        $this->skillTitle = $skillTitle;

        return $this;
    }

    public function getSkillText(): ?string
    {
        return $this->skillText;
    }

    public function setSkillText(string $skillText): static
    {
        $this->skillText = $skillText;

        return $this;
    }

    public function getSkillList(): ?string
    {
        return $this->skillList;
    }

    public function setSkillList(string $skillList): static
    {
        $this->skillList = $skillList;

        return $this;
    }

    /**
     * @return Collection<int, Projects>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Projects $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->addSkill($this);
        }

        return $this;
    }

    public function removeProject(Projects $project): static
    {
        if ($this->projects->removeElement($project)) {
            $project->removeSkill($this);
        }

        return $this;
    }
}
