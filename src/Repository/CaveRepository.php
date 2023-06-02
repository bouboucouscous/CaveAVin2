<?php

namespace App\Repository;

use App\Entity\Cave;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cave>
 *
 * @method Cave|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cave|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cave[]    findAll()
 * @method Cave[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cave::class);
    }

    public function save(Cave $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cave $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllWhitNameWine(int $id)
    {
        $connection = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT v.Nom, c.enter_date, c.exit_date, c.id
            FROM vin v, cave c
            where v.id = c.id_vin_id
            and c.utilistaeur_id_id =' . $id;

        $stmt = $connection->prepare($sql);

        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function getRemplissage(int $id)
    {
        $connection = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT count(c.id)
            FROM cave c
            where c.utilistaeur_id_id =' . $id.
            '
             and c.enter_date is not null
             and c.exit_date is null
            ';

        $stmt = $connection->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $result = $resultSet->fetchAllAssociative();

        $connection2 = $this->getEntityManager()->getConnection();
        $sql2 = '
            SELECT u.nb_place_bouteillle
            FROM Utilisateur u
            where u.id =' . $id;

        $stmt2 = $connection2->prepare($sql2);
        $resultSet2 = $stmt2->executeQuery();
        $result2 = $resultSet2->fetchAllAssociative();

        return $result[0]["count"] * 100 / $result2[0]["nb_place_bouteillle"];
    }

//    /**
//     * @return Cave[] Returns an array of Cave objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Cave
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
