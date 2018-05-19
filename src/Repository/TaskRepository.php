<?php

namespace App\Repository;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Task;

class TaskRepository extends ServiceEntityRepository
{
    /**
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     * @return Task[]
     */
    public function findActiveTasks()
    {
        $qb = $this->createQueryBuilder('t');

        $this->applyActiveCondition($qb);

        return $qb->orderBy('t.priority', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return AbstractQuery
     */
    public function getActiveTasksQuery(): AbstractQuery
    {
        $qb = $this->createQueryBuilder('t');

        $this->applyActiveCondition($qb);

        return $qb->orderBy('t.priority', 'DESC')->getQuery();
    }

    /**
     * @param QueryBuilder $builder
     */
    protected function applyActiveCondition(QueryBuilder $builder): void
    {
        $builder
            ->andWhere('t.active = :active')
            ->setParameter('active', true);
    }
}
