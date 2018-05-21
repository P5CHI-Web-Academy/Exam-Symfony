<?php
namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 * @ORM\Table(name="items")
 * @ORM\HasLifecycleCallbacks()
 */
class Item{

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $note;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $done;

    /**
     * @var datetime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var datetime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var Priority
     * @ORM\ManyToOne(targetEntity="App\Entity\Priority", inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $priority;

    public function __construct()
    {
        $this->done = false;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return Item
     */
    public function setCreatedAt(DateTime $createdAt): Item
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @ORM\PreUpdate()
     */
    public function setUpdatedAt(): void
    {
        $this->updatedAt = new DateTime();
    }

    /**
     * @param Priority|null $priority
     * @return Item
     */
    public function setPriority(?Priority $priority): Item
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return Priority|null
     */
    public function getPriority(): ?Priority
    {
        return $this->priority;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist(): void
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Item
     */
    public function setId(int $id): Item
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param string $note
     * @return Item
     */
    public function setNote(string $note): Item
    {
        $this->note = $note;

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
     * @return Item
     */
    public function setDone(bool $done): Item
    {
        $this->done = $done;

        return $this;
    }
}
