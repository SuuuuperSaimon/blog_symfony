<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Post::class, inversedBy="tags")
     */
    private $name;

    public function __construct()
    {
        $this->name = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Post[]
     */
    public function getName(): Collection
    {
        return $this->name;
    }

    public function addName(Post $name): self
    {
        if (!$this->name->contains($name)) {
            $this->name[] = $name;
        }

        return $this;
    }

    public function removeName(Post $name): self
    {
        if ($this->name->contains($name)) {
            $this->name->removeElement($name);
        }

        return $this;
    }
}
