<?php

namespace App\Repository;

use App\Entity\BingoCard;
use App\Entity\BingoCardCell;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use function Doctrine\ORM\QueryBuilder;

class BingoCardRepository extends EntityRepository
{
    public function findActiveCards(User $user): iterable
    {
        $queryBuilder = $this
            ->createQueryBuilder('bingo_card')
            ->innerJoin('bingo_card.cells', 'cell')
            ->innerJoin('bingo_card.bingo', 'bingo')
        ;

        $queryBuilder
            ->where(
                '(' .
                $queryBuilder->expr()->orX(
                    $queryBuilder->expr()->gte('bingo_card.lastUpdateDateTime', ':thirty_minutes'),
                    $queryBuilder->expr()->eq('cell.state', ':uncheck_state')
                ) . ') AND ' .
                $queryBuilder->expr()->eq('bingo.user', ':user')
            );

        $queryBuilder
            ->setParameter('thirty_minutes', (new \DateTime())->sub(new \DateInterval('PT30M')))
            ->setParameter('uncheck_state', BingoCardCell::UNCHECK_STATE)
            ->setParameter('user', $user);

        return $queryBuilder->getQuery()->getResult();
    }

    public function findOneByUser(User $user): ?BingoCard
    {
        $queryBuilder = $this
            ->createQueryBuilder('bingo_card')
            ->innerJoin('bingo_card.bingo', 'bingo')
        ;

        $queryBuilder->where(
            $queryBuilder->expr()->eq('bingo.user', ':user')
        );

        $queryBuilder
            ->setParameter('user', $user)
        ;

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}
