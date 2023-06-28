<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $iconKey;

    /**
     * @ORM\OneToMany(targetEntity=FortuneCookie::class, mappedBy="category", fetch="EXTRA_LAZY")
     */
    private $fortuneCookies;

    public function __construct()
    {
        $this->fortuneCookies = new ArrayCollection();
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

    public function getIconKey(): ?string
    {
        return $this->iconKey;
    }

    public function setIconKey(?string $iconKey): self
    {
        $this->iconKey = $iconKey;

        return $this;
    }

    /**
     * @return Collection<int, FortuneCookie>
     */
    public function getFortuneCookies(): Collection
    {
        return $this->fortuneCookies;
    }

    public function addFortuneCookie(FortuneCookie $fortuneCookie): self
    {
        if (!$this->fortuneCookies->contains($fortuneCookie)) {
            $this->fortuneCookies[] = $fortuneCookie;
            $fortuneCookie->setCategory($this);
        }

        return $this;
    }

    public function removeFortuneCookie(FortuneCookie $fortuneCookie): self
    {
        if ($this->fortuneCookie->removeElement($fortuneCookie)) {
            // set the owning side to null (unless already changed)
            if ($fortuneCookie->getCategory() === $this) {
                $fortuneCookie->setCategory(null);
            }
        }

        return $this;
    }
}
