<?php

namespace App\Repository;

use App\Entity\CommandPonctuel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandPonctuel|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandPonctuel|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandPonctuel[]    findAll()
 * @method CommandPonctuel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandPonctuelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandPonctuel::class);
    }

    // /**
    //  * @return CommandPonctuel[] Returns an array of CommandPonctuel objects
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
    public function findOneBySomeField($value): ?CommandPonctuel
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
