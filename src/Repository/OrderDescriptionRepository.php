<?php

namespace App\Repository;

use App\Entity\OrderDescription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderDescription>
 *
 * @method OrderDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderDescription[]    findAll()
 * @method OrderDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderDescriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderDescription::class);
    }

//    /**
//     * @return OrderDescription[] Returns an array of OrderDescription objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrderDescription
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
