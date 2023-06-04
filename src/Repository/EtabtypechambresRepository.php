<?php

namespace App\Repository;

use App\Entity\Etabtypechambres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Etabtypedechambres>
 *
 * @method Etabtypedechambres|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etabtypedechambres|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etabtypedechambres[]    findAll()
 * @method Etabtypedechambres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtabtypechambresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etabtypechambres::class);
    }

    public function save(Etabtypechambres $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Etabtypechambres $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Etabtypedechambres[] Returns an array of Etabtypedechambres objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Etabtypedechambres
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
