<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     * Paginated tasks
     *
     * @return \Doctrine\ORM\Query
     */
    public function getPaginatedTasks()
    {
        return $this->createQueryBuilder('t')
            ->select('t')
            ->orderBy('t.priority', 'ASC')
            ->getQuery();
    }

    /**
     * Return searched task
     * @param $query
     * @return mixed
     */
    public function findTasksByKeywords($query)
    {
        return $this->createQueryBuilder('t')
            ->where('t.task like :query')
            ->setParameter('query', '%' . $query . '%')
            ->getQuery()
            ->getResult();
    }
}
