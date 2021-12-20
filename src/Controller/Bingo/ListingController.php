<?php

namespace App\Controller\Bingo;

use App\Entity\Bingo;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bingo/listing')]
class ListingController extends AbstractController
{
    #[Route('/list_bingo', name: 'app_bingo_listing_list_bingo')]
    public function listBingo(ManagerRegistry $managerRegistry): Response
    {
        $bingos = $managerRegistry->getRepository(Bingo::class)->findBy([
            'user' => $this->getUser(),
        ]);

        return $this->render('Page/Bingo/Listing/list_bingo.html.twig', [
            'bingos' => $bingos,
        ]);
    }
}
