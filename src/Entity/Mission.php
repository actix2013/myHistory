<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MissionRepository::class)
 */
class Mission
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $establishmentName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateStart;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="string", length=90, nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $mission;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     */
    private $linkGitHub;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     */
    private $linkWebsite;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     */
    private $linkEstablishment;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $establishmentDepartmentNb;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="missions")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Skill::class, inversedBy="missions")
     */
    private $skills;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
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

    public function getLinkGitHub(): ?string
    {
        return $this->linkGitHub;
    }

    public function setLinkGitHub(?string $linkGitHub): self
    {
        $this->linkGitHub = $linkGitHub;

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

    public function setEstablishmentDepartmentNb(?int $establishmentDepartmentNb): self
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

    public function getSkills(): ?skill
    {
        return $this->skills;
    }

    public function setSkills(?skill $skills): self
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
}