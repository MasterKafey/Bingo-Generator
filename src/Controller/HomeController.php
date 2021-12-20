<?php

namespace App\Controller;

use App\Entity\BingoCard;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(ManagerRegistry $managerRegistry): Response
    {
        $bingoCards = $managerRegistry->getRepository(BingoCard::class)->findActiveCards($this->getUser());

        return $this->render('Page/Home/home.html.twig', [
            'bingo_cards' => $bingoCards,
        ]);
    }
}
