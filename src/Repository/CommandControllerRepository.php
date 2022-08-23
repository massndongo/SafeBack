<?php

namespace App\Repository;

use App\Entity\CommandController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandController|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandController|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandController[]    findAll()
 * @method CommandController[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandControllerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandController::class);
    }

    // /**
    //  * @return CommandController[] Returns an array of CommandController objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommandController
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
