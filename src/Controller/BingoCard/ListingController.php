<?php

namespace App\Controller\BingoCard;

use App\Entity\Bingo;
use App\Entity\BingoCard;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bingo_card/listing')]
class ListingController extends AbstractController
{
    #[Route('/list_bingo_card/{id}', name: 'app_bingo_card_listing_list_bingo_card', requirements: ['id' => '\d+'])]
    public function listBingoCard(Bingo $bingo, ManagerRegistry $managerRegistry): Response
    {
        $bingoCards = $managerRegistry->getRepository(BingoCard::class)->findBy(['bingo' => $bingo]);

        return $this->render('Page/BingoCard/Listing/list_bingo_card.html.twig', [
            'bingo_cards' => $bingoCards,
            'bingo' => $bingo
        ]);
    }
}
