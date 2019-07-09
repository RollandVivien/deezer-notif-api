<?php

namespace App\Repository\Music;

use App\Entity\Music\Playlist;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Repository\RepoInterface\SpecListnotifInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Playlist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Playlist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Playlist[]    findAll()
 * @method Playlist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaylistRepository extends ServiceEntityRepository implements SpecListnotifInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Playlist::class);
    }

    public function findOneForListNotifs(int $id){
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->leftJoin('p.author','au')
            ->addSelect('au')            
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
        ;        
    }
    // /**
    //  * @return Playlist[] Returns an array of Playlist objects
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
    public function findOneBySomeField($value): ?Playlist
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
