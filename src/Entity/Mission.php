<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MissionRepository::class)
 */
class Mission
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
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="l'etablissement doit contenir que des lettres"
     * )
     * @var string
     */
    private $establishmentName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date
     * @var \DateTimeInterface|null
     */
    private $dateStart;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date
     * @var \DateTimeInterface|null
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="string", length=90, nullable=true)
     * @var string
     */
    private $comment;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $mission;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     * @var string
     */
    private $linkEstablishment;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @var string|null
     */
    private $establishmentDepartmentNb;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="missions")
     * @var \App\Entity\User
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Skill::class, inversedBy="missions")
     * @var ArrayCollection<int, \App\Entity\Skill>
     */
    private $skills;

    /**
     * @ORM\OneToMany(targetEntity=Task::class, mappedBy="mission")
     * @var ArrayCollection<int,\App\Entity\Task>
     */
    private $tasks;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     * @var string
     */
    private $duration;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstablishmentName(): ?string
    {
        return $this->establishmentName;
    }

    public function setEstablishmentName(string $establishmentName): self
    {
        $this->establishmentName = $establishmentName;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(?\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(?\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getMission(): ?string
    {
        return $this->mission;
    }

    public function setMission(?string $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getLinkEstablishment(): ?string
    {
        return $this->linkEstablishment;
    }

    public function setLinkEstablishment(?string $linkEstablishment): self
    {
        $this->linkEstablishment = $linkEstablishment;

        return $this;
    }

    public function getEstablishmentDepartmentNb(): ?string
    {
        return $this->establishmentDepartmentNb;
    }

    public function setEstablishmentDepartmentNb(?string $establishmentDepartmentNb) : self
    {
        $this->establishmentDepartmentNb = $establishmentDepartmentNb;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection<int,Skill>
     */
    public function getSkills(): ArrayCollection
    {
        return $this->skills;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection<int, Skill>|null $skills
     */
    public function setSkills(?ArrayCollection $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->skills->contains($skill)) {
            $this->skills->removeElement($skill);
        }

        return $this;
    }

    /**
     * @return Collection<int, \App\Entity\Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setMission($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->contains($task)) {
            $this->tasks->removeElement($task);
            // set the owning side to null (unless already changed)
            if ($task->getMission() === $this) {
                $task->setMission(null);
            }
        }

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }
}
