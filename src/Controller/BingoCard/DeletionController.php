<?php

namespace App\Controller\BingoCard;

use App\Entity\BingoCard;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bingo_card/deletion')]
class DeletionController extends AbstractController
{
    #[Route('/delete_bingo_card/{id}', name: 'app_bingo_card_deletion_delete_bingo_card', requirements: ['id' => '\d+'])]
    public function deleteBingoCard(BingoCard $bingoCard, ManagerRegistry $managerRegistry): RedirectResponse
    {
        $bingo = $bingoCard->getBingo();

        $em = $managerRegistry->getManager();
        $em->remove($bingoCard);
        $em->flush();

        return $this->redirectToRoute('app_bingo_card_listing_list_bingo_card', ['id' => $bingo->getId()]);
    }
}
