<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HistoryRepository", repositoryClass=HistoryRepository::class)
 */
class History
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\Column(type="date")
     * @Assert\Date
     *
     * @var null|\DateTimeInterface
     */
    protected $dateCreated;
    /**
     * @ORM\Column(type="string", length=45)
     */
    private $userName;
    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     * @Assert\Length(
     *     min=10,
     *     max=50,
     *     minMessage="La description doit faire au minimum {{ limit }} characteres de long",
     *     maxMessage="La description ne peut pas etre plus long que {{ limit }} characteres",
     *     allowEmptyString=false
     * )
     */
    private $description;
    /**
     * @ORM\Column(type="float")
     */
    private $timestamp;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $source;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $host;

    public function __construct()
    {
        $this->dateCreated = new DateTime('now');
        $this->timestamp = $this->dateCreated->getTimestamp() ?: 0;
    }

    public function getId(): ?int
    {
        return $this->id ? $this->id : rand(9999, 99999);
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTimestamp(): ?float
    {
        return $this->timestamp;
    }

    public function setTimestamp(float $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function setHost(?string $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function __toArray()
    {
        return [
            'id' => $this->getId(),
            'userName' => $this->userName,
            'dateCreated' => $this->getDateCreated(),
            'description' => $this->getDescription(),
            'timeStamp' => $this->getTimestamp(),
            'source' => $this->getSource(),
            'host' => $this->getHost(),
        ];
    }
}
