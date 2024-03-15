<?php

namespace App\Repository;

use App\Entity\PublishData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<PublishData>
 *
 * @method PublishData|null find($id, $lockMode = null, $lockVersion = null)
 * @method PublishData|null findOneBy(array $criteria, array $orderBy = null)
 * @method PublishData[]    findAll()
 * @method PublishData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublishDataRepository extends ServiceEntityRepository
{
    private $paginator;
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, PublishData::class);
        $this->paginator=$paginator;
    }

    public function findAllPaginated($page,$mail){
        $dbquery=$this->createQueryBuilder('v')
        ->where('v.email = :email')
        ->setParameter('email',$mail)
        ->getQuery();

        $pagination=$this->paginator->paginate($dbquery,$page,4);
        return $pagination;
    }

    public function AllPaginator($page,$mail){
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


    public function searching($str,$mail){
        $dbquery=$this->createQueryBuilder('v')
        ->where('v.email= :email')
        ->andWhere('v.title like :title')
        ->setParameter('email',$mail)
        ->setParameter('title', '%'.$str.'%')
        ->getQuery();

        $result=$dbquery->getResult();
        return $result;
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
    public function add(PublishData $entity, bool $flush = true): void
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
    public function remove(PublishData $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return PublishData[] Returns an array of PublishData objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PublishData
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
