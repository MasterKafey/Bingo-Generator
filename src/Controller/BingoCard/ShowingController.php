<?php

namespace App\Controller\BingoCard;

use App\Entity\BingoCard;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bingo_card/showing')]
class ShowingController extends AbstractController
{
    #[Route('/show_bingo_card/{id}', name: 'app_bingo_card_showing_show_bingo_card')]
    public function showBingoCard(BingoCard $bingoCard): Response
    {
        return $this->render('Page/BingoCard/Showing/show_bingo_card.html.twig', [
            'bingo_card' => $bingoCard,
        ]);
    }
}