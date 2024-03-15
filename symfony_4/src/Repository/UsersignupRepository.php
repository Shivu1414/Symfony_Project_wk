<?php

namespace App\Repository;

use App\Entity\Usersignup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<Usersignup>
 *
 * @method Usersignup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usersignup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usersignup[]    findAll()
 * @method Usersignup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersignupRepository extends ServiceEntityRepository
{
    private $paginator;
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Usersignup::class);
        $this->paginator=$paginator;
    }

    public function findAllPaginated($page){
        $dbquery=$this->createQueryBuilder('v')
        // ->where('v.email = :email')
        // ->setParameter('email',$mail)
        ->getQuery();

        $pagination=$this->paginator->paginate($dbquery,$page,4);
        return $pagination;
    }


    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Usersignup $entity, bool $flush = true): void
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
    public function remove(Usersignup $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Usersignup[] Returns an array of Usersignup objects
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
    public function findOneBySomeField($value): ?Usersignup
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
