<?php

namespace App\Repository;

use App\Entity\SubCategories;
use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubCategories[]    findAll()
 * @method SubCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubCategories::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(SubCategories $entity, bool $flush = true): void
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
    public function remove(SubCategories $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return SubCategories[] Returns an array of SubCategories objects
    //  */
    
    public function findByActive()
    {
        return $this->createQueryBuilder('s')
             ->where('s.lost = 0 ')
            ->andWhere('s.active = 1')
            ->andWhere('s.isfound = 0')
            // ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    public function findByUser( $user)
    {
        return $this->createQueryBuilder('s')
             ->where('s.lost = 0 ')
            ->andWhere('s.active = 1')
            ->andWhere('s.isfound = 0')
            ->andWhere('s.Users = :user')
             ->setParameter('user', $user)
            ->orderBy('s.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function lostByUser( $user)
    {
        return $this->createQueryBuilder('s')
            ->where('s.lost = 1 ')
            ->andWhere('s.active = 1')
            ->andWhere('s.isfound = 0')
            ->andWhere('s.Users = :user')
            ->setParameter('user', $user)
            ->orderBy('s.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByCategory( $category ,$user)
    {
        return $this->createQueryBuilder('s')
             ->where('s.lost = 1 ')
            ->andWhere('s.active = 1')
            ->andWhere('s.isfound = 0')
            ->andWhere('s.Users != :user')
            ->andWhere('s.categories =:category')
            
             ->setParameter('user', $user)
             ->setParameter('category', $category)
            ->orderBy('s.categoriesdetails', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    

    public function findByDetailsCategory( $categoriesdetails ,$user)
    {
        return $this->createQueryBuilder('s')
             ->where('s.lost = 1 ')
            ->andWhere('s.active = 1')
            ->andWhere('s.isfound = 0')
            ->andWhere('s.Users != :user')
            ->andWhere('s.categoriesdetails =:categoriesdetails')
             ->setParameter('user', $user)
             ->setParameter('categoriesdetails', $categoriesdetails)
            ->orderBy('s.categoriesdetails', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findByobjectname( $objectname ,$user)
    {
        return $this->createQueryBuilder('s')
             ->where('s.lost = 1 ')
            ->andWhere('s.active = 1')
            ->andWhere('s.isfound = 0')
            ->andWhere('s.Users != :user')
            ->andWhere('s.objectname =:objectname')
             ->setParameter('user', $user)
             ->setParameter('objectname', $objectname)
            ->orderBy('s.categoriesdetails', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?SubCategories
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    // public function findAllGreaterThanPrice(int $categoriesid, ): array
    // {
    //     // automatically knows to select Products
    //     // the "p" is an alias you'll use in the rest of the query
    //     $qb = $this->createQueryBuilder('s')
    //         ->where('s.categories_id = :categories_id')
    //         ->setParameter('categories_id', $categoriesid)
    //         ->orderBy('s.categories_id', 'ASC');
        

    //     $query = $qb->getQuery();

    //     return $query->execute();

    //     // to get just one result:
    //     // $product = $query->setMaxResults(1)->getOneOrNullResult();

    // }
}
