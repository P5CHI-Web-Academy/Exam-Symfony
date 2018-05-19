<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;

trait TimestampsTrait
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return self
     */
    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     *
     * @return void
     */
    public function presetTimestamps(): void
    {
        if (!$this->createdAt) {
            $this->createdAt = new \DateTime();
        }

        if (!$this->updatedAt) {
            $this->updatedAt = new \DateTime();
        }
    }

    /**
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function updateTimestamps(): void
    {
        $this->updatedAt = new \DateTime();
    }
}
