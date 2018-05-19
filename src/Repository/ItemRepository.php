<?php

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ItemRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Item::class);
    }

    /**
     * @return Item[]
     */
    public function findAllItemsSortedBypriority(): array
    {
        return $this->createQueryBuilder('i')
            ->select('i')
            ->innerJoin('i.priority', 'p')
            ->addOrderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
