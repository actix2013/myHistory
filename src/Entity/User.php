<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email
     * @Assert\NotBlank
     * @Assert\Length(
     *     min=3,
     *     max=70,
     *     minMessage="L'email doit faire au minimum {{ limit }} characteres de long",
     *     maxMessage="L'email ne peut pas etre plus long que {{ limit }} characteres",
     *     allowEmptyString=false
     * )
     *
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Assert\NotBlank
     * @Assert\Length(
     *     min=6,
     *     max=255,
     *     minMessage="La somme des roles doit depasser {{ limit }} characteres",
     *     maxMessage="La somme des roles ne doit pas depasser {{ limit }} characteres",
     *     allowEmptyString=false
     * )
     *
     * @var array<string>
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Length(
     *     min=8,
     *     max=300,
     *     minMessage="Le hash du password doit depasser {{ limit }} characteres",
     *     maxMessage="Le hash du password ne doit pas depasser {{ limit }} characteres",
     *     allowEmptyString=false
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=45)
     * @Assert\Type("string")
     * @Assert\NotBlank
     * @Assert\Length(
     *     min=3,
     *     max=45,
     *     minMessage="Le prénom doit faire au minimum {{ limit }} characteres de long",
     *     maxMessage="Le prénom ne peut pas etre plus long que {{ limit }} characteres",
     *     allowEmptyString=false
     * )
     *
     * @var string
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=45)
     * @Assert\Type("string")
     * @Assert\NotBlank
     * @Assert\Length(
     *     min=3,
     *     max=45,
     *     minMessage="Le prénom doit faire au minimum {{ limit }} characteres de long",
     *     maxMessage="Le prénom ne peut pas etre plus long que {{ limit }} characteres",
     *     allowEmptyString=false
     * )
     *
     * @var string
     */
    private $lastName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type("string")
     * @Assert\NotBlank
     * @Assert\Length(
     *     min=3,
     *     max=45,
     *     minMessage="Le prénom doit faire au minimum {{ limit }} characteres de long",
     *     maxMessage="Le prénom ne peut pas etre plus long que {{ limit }} characteres",
     *     allowEmptyString=false
     * )
     * @Assert\Positive
     *
     * @var int
     */
    private $age;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="integer",
     *     message="La valeur "{{ value }}" n'est pasde type : {{ type }}."
     * )
     *
     * @var int
     */
    private $nbChild;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $addressStreet;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     *
     * @var string
     */
    private $addressStreetNumber;

    /**
     * @ORM\Column(type="string", length=90, nullable=true)
     *
     * @var string
     */
    private $addressCity;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     *
     * @var string
     */
    private $mobile;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     *
     * @var string
     */
    private $profil;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    private $active;

    /**
     * @ORM\OneToMany(targetEntity=Mission::class, mappedBy="user")
     *
     * @var Collection<int, Mission>
     */
    private $missions;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
    }

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array<string> $roles
     *
     * @return $this
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
         //$this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getNbChild(): ?int
    {
        return $this->nbChild;
    }

    public function setNbChild(int $nbChild): self
    {
        $this->nbChild = $nbChild;

        return $this;
    }

    public function getAddressStreet(): ?string
    {
        return $this->addressStreet;
    }

    public function setAddressStreet(string $addressStreet): self
    {
        $this->addressStreet = $addressStreet;

        return $this;
    }

    public function getAddressStreetNumber(): ?string
    {
        return $this->addressStreetNumber;
    }

    public function setAddressStreetNumber(string $addressStreetNumber): self
    {
        $this->addressStreetNumber = $addressStreetNumber;

        return $this;
    }

    public function getAddressCity(): ?string
    {
        return $this->addressCity;
    }

    public function setAddressCity(string $addressCity): self
    {
        $this->addressCity = $addressCity;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getProfil(): ?string
    {
        return $this->profil;
    }

    public function setProfil(string $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection<int,Mission>
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): User
    {
        if (!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
            $mission->setUser($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->contains($mission)) {
            $this->missions->removeElement($mission);
            // set the owning side to null (unless already changed)
            if ($mission->getUser() === $this) {
                $mission->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->firstName.' '.$this->lastName;
    }
}
