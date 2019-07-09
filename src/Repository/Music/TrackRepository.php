<?php

namespace App\Repository\Music;

use App\Entity\Music\Track;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Repository\RepoInterface\SpecListnotifInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Track|null find($id, $lockMode = null, $lockVersion = null)
 * @method Track|null findOneBy(array $criteria, array $orderBy = null)
 * @method Track[]    findAll()
 * @method Track[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrackRepository extends ServiceEntityRepository implements SpecListnotifInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Track::class);
    }

    public function findOneForListNotifs(int $id){
        return $this->createQueryBuilder('t')
            ->andWhere('t.id = :id')
            ->leftJoin('t.album','alb')
            ->addSelect('alb') 
            ->leftJoin('alb.artist','ar')
            ->addSelect('ar')                        
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
        ;        
    }
    // /**
    //  * @return Track[] Returns an array of Track objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Track
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
