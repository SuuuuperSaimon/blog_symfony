<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait TimestampableTrait
{
    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     *
     * @throws \Exception
     */
    public function updatedAtTimestamp()
    {
        $this->setUpdatedAt(new \DateTime());

        if ($this->getCreatedAt() == null) {
            $this->setCratedAt(new \DateTime());
        }
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $dateTime
     *
     * @return TimestampableTrait
     */
    public function setCratedAt(\DateTimeInterface $dateTime): self
    {
        $this->createdAt = $dateTime;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface $dateTime
     *
     * @return TimestampableTrait
     */
    public function setUpdatedAt(\DateTimeInterface $dateTime): self
    {
        $this->updatedAt = $dateTime;

        return $this;
    }
}