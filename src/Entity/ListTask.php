<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ListTaskRepository")
 */
class ListTask
{
    const HIGH_PRIORITY = 3;
    const NORMAL_PRIORITY = 2;
    const LOW_PRIORITY = 1;
    const TYPES = [
        self::HIGH_PRIORITY,
        self::NORMAL_PRIORITY,
        self::LOW_PRIORITY,
    ];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $priority;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $done;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getTitle(): ?string
    {
        return $this->title;
    }
    
    public function setTitle(string $title): self
    {
        $this->title = $title;
        
        return $this;
    }
    
    public function getPriority(): ?int
    {
        return $this->priority;
    }
    
    public function setPriority(int $priority): self
    {
        $this->priority = $priority;
        
        return $this;
    }
    
    public function getDone(): ?bool
    {
        return $this->done;
    }
    
    public function setDone(bool $done): self
    {
        $this->done = $done;
        
        return $this;
    }
}
