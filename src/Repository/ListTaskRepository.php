<?php

namespace App\Repository;

use App\Entity\ListTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ListTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListTask[]    findAll()
 * @method ListTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListTaskRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ListTask::class);
    }
    
    public function sortTaskList()
    {
        return $this->createQueryBuilder('list_task')
            ->select('list_task')
            ->addOrderBy('list_task.priority', 'ASC')
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return ListTask[] Returns an array of ListTask objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    
    /*
    public function findOneBySomeField($value): ?ListTask
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
