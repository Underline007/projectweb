<?php

namespace App\Repository;

use App\Entity\Studentmanager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Studentmanager|null find($id, $lockMode = null, $lockVersion = null)
 * @method Studentmanager|null findOneBy(array $criteria, array $orderBy = null)
 * @method Studentmanager[]    findAll()
 * @method Studentmanager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentmanagerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Studentmanager::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Studentmanager $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Studentmanager $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

     /**
    * @return Studentmanager[]  
    */

    public function sortNameAscending()
    {
        //SQL: SELECT * FROM book ORDER BY title ASC
        return $this->createQueryBuilder('b')
            ->orderBy('b.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return Studentmanager[]  
    */

    public function sortNameDescending()
    {
        //SQL: SELECT * FROM book ORDER BY title DESC
        return $this->createQueryBuilder('b')
            ->orderBy('b.name', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }


    // /**
    //  * @return Studentmanager[] Returns an array of Studentmanager objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Studentmanager
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
