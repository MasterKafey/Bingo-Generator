<?php

namespace App\Controller\BingoCard;

use App\Entity\Bingo;
use App\Entity\BingoCard;
use App\Entity\BingoCardCell;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bingo_card/creation')]
class CreationController extends AbstractController
{
    #[Route('/create_bingo_card/{id}', name: 'app_bingo_card_creation_create_bingo_card', requirements: ['id' => '\d+'])]
    public function createBingoCard(Bingo $bingo, ManagerRegistry $managerRegistry): Response
    {
        $bingoCard = (new BingoCard())->setBingo($bingo);
        $cells = $bingo->getCells();
        $bingoCardCells = [];

        foreach ($cells as $cell) {
            $bingoCardCells[] = (new BingoCardCell())->setBingoCell($cell);
        }

        shuffle($bingoCardCells);
        $bingoCard
            ->setCells($bingoCardCells)
            ->setCreationDateTime(new \DateTime())
            ->setLastUpdateDateTime(new \DateTime())
        ;

        $em = $managerRegistry->getManager();
        $em->persist($bingoCard);
        $em->flush();

        return $this->redirectToRoute('app_bingo_card_showing_show_bingo_card', [
            'id' => $bingoCard->getId(),
        ]);
    }
}
