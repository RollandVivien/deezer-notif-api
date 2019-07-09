<?php

namespace App\Repository\Notif;

use App\Entity\User\User;
use App\Entity\Notif\NotificationUser;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method NotificationUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotificationUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotificationUser[]    findAll()
 * @method NotificationUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotificationUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NotificationUser::class);
    }

    public function findList(User $user){
        return $this->createQueryBuilder('nu')
            ->andWhere('nu.user = :user')
            ->setParameter('user', $user)
            ->orderBy('nu.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findListForCounting(User $user,bool $onlyNotSeen = false) : int {
        $query = $this->createQueryBuilder('nu')
            ->andWhere('nu.user = :user')
            ->setParameter('user', $user)
            ->orderBy('nu.id', 'DESC');
            if($onlyNotSeen){
                $query = $query->andWhere('nu.seen = false');
            }
            $query = $query->getQuery()
            ->getResult()
        ;
        return count($query);
    }
    // /**
    //  * @return NotificationUser[] Returns an array of NotificationUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NotificationUser
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
