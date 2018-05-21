<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="priorities")
 */
class Priority{

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
    private $name;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Item", mappedBy="priority")
     */
    private $items;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Priority
     */
    public function setId(int $id): Priority
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Priority
     */
    public function setName(string $name): Priority
    {
        $this->name = $name;

        return $this;
    }

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }


    /**
     * @return Collection|Item[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @param Item $item
     * @return Priority
     */
    public function addItem(Item $item): Priority
    {
        if(!$this->items->contains($item)) {
            $this->items->add($item);
        }

        return $this;
    }

    /**
     * @param Item $item
     * @return Priority
     */
    public function removeItem(Item $item): Priority
    {
        $this->items->removeElement($item);
        return $this;
    }
}
