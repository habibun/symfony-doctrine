<?php

namespace App\Entity;

use App\Repository\FortuneCookieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FortuneCookieRepository::class)
 */
class FortuneCookie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="fortuneCookies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fortune;

    /**
     * @ORM\Column(type="integer", length=255, options={"default" : 0})
     */
    private int $numberPrinted = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private \DateTime $createdAt;

    /**
     * FortuneCookie constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getFortune(): ?string
    {
        return $this->fortune;
    }

    public function setFortune(string $fortune): self
    {
        $this->fortune = $fortune;

        return $this;
    }

    public function getNumberPrinted(): int
    {
        return $this->numberPrinted;
    }

    public function setNumberPrinted(int $numberPrinted): FortuneCookie
    {
        $this->numberPrinted = $numberPrinted;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt ?? null;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return FortuneCookie
     */
    public function setCreatedAt(\DateTime $createdAt): FortuneCookie
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
