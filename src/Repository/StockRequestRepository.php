<?php

namespace App\Repository;
use App\Entity\StockRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StockRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockRequest[]    findAll()
 * @method StockRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockRequest::class);
    }

    public function getMaxSerialNo(){
        $qb=$this->createQueryBuilder('st')
                    ->andWhere('st.id > :ids')
                    ->setParameter('ids', 0)
                    ->orderBy('st.serialNumber', "DESC")
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getResult();

            return $qb;
    }
    // /**
    //  * @return StockRequest[] Returns an array of StockRequest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StockRequest
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
