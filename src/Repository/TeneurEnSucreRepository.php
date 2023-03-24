<?php

namespace App\Repository;

use App\Entity\TeneurEnSucre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TeneurEnSucre>
 *
 * @method TeneurEnSucre|null find($id, $lockMode = null, $lockVersion = null)
 * @method TeneurEnSucre|null findOneBy(array $criteria, array $orderBy = null)
 * @method TeneurEnSucre[]    findAll()
 * @method TeneurEnSucre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeneurEnSucreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TeneurEnSucre::class);
    }

    public function save(TeneurEnSucre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TeneurEnSucre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TeneurEnSucre[] Returns an array of TeneurEnSucre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TeneurEnSucre
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
