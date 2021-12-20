<?php

namespace App\Controller\BingoCardCell;

use App\Entity\BingoCardCell;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bingo_card_cell/edition')]
class EditionController extends AbstractController
{
    #[Route('/check_bingo_card_cell/{id}', name: 'app_bingo_card_cell_edition_check_bingo_card_cell', options: ['expose' => true])]
    public function checkBingoCardCell(BingoCardCell $bingoCardCell, ManagerRegistry $managerRegistry): JsonResponse
    {
        $bingoCardCell->setState(BingoCardCell::CHECK_STATE);
        $bingoCard = $bingoCardCell->getBingoCard()->setLastUpdateDateTime(new \DateTime());
        $em = $managerRegistry->getManager();
        $em->persist($bingoCardCell);
        $em->persist($bingoCard);
        $em->flush();

        return $this->json(['result' => true]);
    }

    #[Route('/uncheck_bingo_card_cell/{id}', name: 'app_bingo_card_cell_edition_uncheck_bingo_card_cell', options: ['expose' => true])]
    public function uncheckBingoCardCell(BingoCardCell $bingoCardCell, ManagerRegistry $managerRegistry): JsonResponse
    {
        $bingoCardCell->setState(BingoCardCell::UNCHECK_STATE);
        $bingoCard = $bingoCardCell->getBingoCard()->setLastUpdateDateTime(new \DateTime());
        $em = $managerRegistry->getManager();
        $em->persist($bingoCardCell);
        $em->persist($bingoCard);
        $em->flush();

        return $this->json(['result' => true]);
    }
}
