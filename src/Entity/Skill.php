<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillRepository::class)
 */
class Skill
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
     * @ORM\ManyToMany(targetEntity=Mission::class, mappedBy="skills")
     * @var ArrayCollection<int, \App\Entity\Mission>
     */
    private $missions;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="skills")
     * @ORM\JoinColumn(nullable=false)
     * @var \App\Entity\Category
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Task::class, mappedBy="skills")
     * @var ArrayCollection<int,\App\Entity\Task>
     */
    private $tasks;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
        $this->tasks = new ArrayCollection();
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
     * @return ArrayCollection<int, Mission>
     */
    public function getMissions(): ArrayCollection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
            $mission->addSkill($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->contains($mission)) {
            $this->missions->removeElement($mission);
            $mission->removeSkill($this);
        }

        return $this;
    }

    /**
     * @return \App\Entity\Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return ArrayCollection<int, \App\Entity\Task>
     */
    public function getTasks(): ArrayCollection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->addSkill($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->contains($task)) {
            $this->tasks->removeElement($task);
            $task->removeSkill($this);
        }

        return $this;
    }
}
