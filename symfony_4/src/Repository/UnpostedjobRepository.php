<?php

namespace App\Repository;

use App\Entity\Unpostedjob;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<Unpostedjob>
 *
 * @method Unpostedjob|null find($id, $lockMode = null, $lockVersion = null)
 * @method Unpostedjob|null findOneBy(array $criteria, array $orderBy = null)
 * @method Unpostedjob[]    findAll()
 * @method Unpostedjob[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnpostedjobRepository extends ServiceEntityRepository
{
    private $paginator;
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Unpostedjob::class);
        $this->paginator=$paginator;
    }

    public function findAllPaginated($page,$mail){
        $dbquery=$this->createQueryBuilder('v')
        ->where('v.email = :email')
        ->setParameter('email',$mail)
        ->getQuery();

        $pagination=$this->paginator->paginate($dbquery,$page,8);
        return $pagination;
    }

    public function findAllSearch($page,$mail,$str){
        $dbquery=$this->createQueryBuilder('v')
        ->where('v.email = :email')
        ->andWhere('v.title like :title')
        ->setParameter('email',$mail)
        ->setParameter('title', '%'.$str.'%')
        ->getQuery();

        $pagination=$this->paginator->paginate($dbquery,$page,8);
        return $pagination;
    }


    public function finddata($mail){
        $dbquery=$this->createQueryBuilder('v')
        ->where('v.email= :email')
        ->setParameter('email',$mail)
        ->getQuery();

        $result=$dbquery->getResult();
        return $result;
    }


    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Unpostedjob $entity, bool $flush = true): void
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
    public function remove(Unpostedjob $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Unpostedjob[] Returns an array of Unpostedjob objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Unpostedjob
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
