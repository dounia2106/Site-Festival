<?php

namespace App\Repository;

use App\Entity\Offre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Offre>
 *
 * @method Offre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offre[]    findAll()
 * @method Offre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offre::class);
    }

    public function save(Offre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Offre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

 /*
 /** 
   * @return Offre[] Returns an array of Groupes objects
  

public function findByNbC(): array
{
   return $this->createQueryBuilder('o')
 ->andWhere('o.nombreChambres > :val')
 ->andWhere('o.typeschambres.libelle = :val1')
 ->setParameter('val', 0)
 ->setParameter('val1', "simple") 
 ->orderBy('o.nombreChambres', 'ASC')
 ->getQuery()
 ->getResult() ;
 }*/



 
    /**
     * @return Offre[]
     */
    public function findByNbC(int $id , int $n ): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT o.id, e.nom, e.ville
            , t.libelle, o.nombreChambres FROM App\Entity\Offre o, App\Entity\Etablissement e,App\Entity\TypeChambre t 
            WHERE o.etablissement=e.id and 
            o.typeschambres= t.id and t.id = :val and o.nombreChambres >:val1'
        )->setParameter('val', $id)
        ->setParameter('val1', $nb)
        ;

        // returns an array of Product objects
        return $query->getResult();
    }

//    public function findOneBySomeField($value): ?Offre
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


    /**
     * @return Offre[]
     */
    public function findByNbC1(int $id , int $nb ): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT o FROM App\Entity\Offre o, App\Entity\Etablissement e,App\Entity\TypeChambre t 
            WHERE o.etablissement=e.id and 
            o.typeschambres= t.id and t.id = :val and o.nombreChambres >:val1'
        )->setParameter('val', $id)
        ->setParameter('val1', $nb)
        ;

        // returns an array of Product objects
        return $query->getResult();
    }



}
