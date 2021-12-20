<?php

namespace App\Repository;

use App\Entity\BingoCardCell;
use Doctrine\ORM\EntityRepository;
use function Doctrine\ORM\QueryBuilder;

class BingoCardRepository extends EntityRepository
{
    public function findActiveCards(): iterable
    {
        $queryBuilder = $this
            ->createQueryBuilder('bingo_card')
            ->innerJoin('bingo_card.cells', 'cell');

        $queryBuilder
            ->where(
                $queryBuilder->expr()->orX(
                    $queryBuilder->expr()->gte('bingo_card.lastUpdateDateTime', ':thirty_minutes'),
                    $queryBuilder->expr()->eq('cell.state', ':uncheck_state')
                )
            );

        $queryBuilder
            ->setParameter('thirty_minutes', (new \DateTime())->sub(new \DateInterval('PT30M')))
            ->setParameter('uncheck_state', BingoCardCell::UNCHECK_STATE);

        return $queryBuilder->getQuery()->getResult();
    }
}
