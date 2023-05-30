<?php

namespace App\Repository;

use App\Entity\Vin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Vin>
 *
 * @method Vin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vin[]    findAll()
 * @method Vin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vin::class);
    }

    public function save(Vin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Vin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    

    public function paginationQuery()
    {
        return $this->createQueryBuilder('v')
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery() ;
    }

    public function getDistinctAnnees()
    {
        $queryBuilder = $this->createQueryBuilder('v')
        ->select("v.Annee")
        ->orderBy('v.Annee', 'ASC')
        ->groupBy('v.Annee')
        ->getQuery()
        ->getResult();

        $annees = array_map(function ($queryBuilder) {
            return $queryBuilder['Annee']->format('Y');;
        }, $queryBuilder);

        return $annees;
    }

    public function getDistinctFormat()
    {
        $queryBuilder = $this->createQueryBuilder('v')
        ->select("v.formatCl")
        ->orderBy('v.formatCl', 'ASC')
        ->groupBy('v.formatCl')
        ->getQuery()
        ->getResult();

        $annees = array_map(function ($queryBuilder) {
            return $queryBuilder['formatCl'];
        }, $queryBuilder);

        return $annees;
    }

    public function getDistinctRobe()
    {
        $connection = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT DISTINCT r.couleur_robe
            FROM robe r
            WHERE r.id IN (
                SELECT v.robe_id
                FROM vin v
            )
            ORDER BY r.couleur_robe ASC
        ';

        $stmt = $connection->prepare($sql);

        $resultSet = $stmt->executeQuery();

        $resultSet->fetchAllAssociative();
    }

    public function getDistinctTeneurEnSucre()
    {
        $connection = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT DISTINCT t.gout
            FROM teneur_en_sucre t
            WHERE t.id IN (
                SELECT v.teneur_en_sucre_id
                FROM vin v
            )
            ORDER BY t.gout ASC
        ';

        $stmt = $connection->prepare($sql);

        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

//    public function findOneBySomeField($value): ?Vin
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
