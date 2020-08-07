<?php

namespace App\Entity;

use App\Entity\Skill;
use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     * @var string
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=skill::class, inversedBy="tasks")
     * @var ArrayCollection<int, Skill>
     */
    private $skills;

    /**
     * @ORM\ManyToOne(targetEntity=Mission::class, inversedBy="tasks")
     * @var \App\Entity\Mission
     */
    private $mission;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     * @var string
     */
    private $linkGithub;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     * @var string
     */
    private $linkWebsite;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ArrayCollection<int, Skill>|skill[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(skill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
        }

        return $this;
    }

    public function removeSkill(skill $skill): self
    {
        if ($this->skills->contains($skill)) {
            $this->skills->removeElement($skill);
        }

        return $this;
    }

    public function getMission(): ?Mission
    {
        return $this->mission;
    }

    public function setMission(?Mission $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getLinkGithub(): ?string
    {
        return $this->linkGithub;
    }

    public function setLinkGithub(?string $linkGithub): self
    {
        $this->linkGithub = $linkGithub;

        return $this;
    }

    public function getLinkWebsite(): ?string
    {
        return $this->linkWebsite;
    }

    public function setLinkWebsite(?string $linkWebsite): self
    {
        $this->linkWebsite = $linkWebsite;

        return $this;
    }
}
