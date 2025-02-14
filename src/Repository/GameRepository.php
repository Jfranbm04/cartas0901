<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    //    /**
    //     * @return Game[] Returns an array of Game objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Game
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    /**
     * Encuentra las partidas con resultado NULL
     * @return Game[]
     */
    public function findGamesWithNullResult(): array
    {
        return $this->createQueryBuilder('game')
            ->andWhere('game.result IS NULL')
            ->getQuery()
            ->getResult();
    }

    // Encontrar partidas completas según id del usuario
    public function findGamesByUser($user): array
    {
        return $this->createQueryBuilder('game')
            ->where('game.Local = :user')
            ->orwhere('game.away = :user')
            // ->andWhere('game.result IS NOT NULL')
            ->setParameter('user', $user)  // Aquí defino el valor para :userId
            ->getQuery()
            ->getResult();
    }
}
