<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 * @ORM\Table(name="tasks")
 * @ORM\HasLifecycleCallbacks()
 */
class Task
{
    const HIGH = 10;
    const NORMAL = 5;
    const LOW = 0;

    const PRIORITY_TYPES = [
        self::HIGH,
        self::NORMAL,
        self::LOW,
    ];

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=500)
     */
    private $task;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $priority;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_done", type="boolean")
     */
    private $done;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $active;

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
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $doneAt;

    /**
     * Task constructor.
     */
    public function __construct()
    {
        $this->active = true;
        $this->done = false;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTask(): ?string
    {
        return $this->task;
    }

    /**
     * @param string $task
     * @return Task
     */
    public function setTask(string $task): Task
    {
        $this->task = $task;

        return $this;
    }

    /**
     * @return int|null
     */
    public function isPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     * @return Task
     */
    public function setPriority(int $priority): Task
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isDone(): ?bool
    {
        return $this->done;
    }

    /**
     * @param bool $done
     * @return Task
     */
    public function setDone(bool $done): Task
    {
        $this->done = $done;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return Task
     */
    public function setActive(bool $active): Task
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Task
     */
    public function setCreatedAt(\DateTime $createdAt): Task
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
     * @return Task
     */
    public function setUpdatedAt(\DateTime $updatedAt): Task
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDoneAt(): ?\DateTime
    {
        return $this->doneAt;
    }

    /**
     * @param \DateTime $doneAt
     * @return Task
     */
    public function setDoneAt(\DateTime $doneAt): Task
    {
        $this->doneAt = $doneAt;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();

    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return array
     */
    public static function getPriorityList()
    {
        return [
            self::HIGH => 'High',
            self::NORMAL => 'Normal',
            self::LOW => 'Low',
        ];
    }
}
