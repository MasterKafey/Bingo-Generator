<?php

namespace App\Controller\Bingo;

use App\Entity\Bingo;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bingo/deletion')]
class DeletionController extends AbstractController
{
    #[Route('/delete_bingo/{id}', name: 'app_bingo_deletion_delete_bingo', requirements: ['id' => '\d+'])]
    public function deleteBingo(Bingo $bingo, ManagerRegistry $managerRegistry): RedirectResponse
    {
        if ($bingo->getUser() === $this->getUser()) {
            $em = $managerRegistry->getManager();
            $em->remove($bingo);
            $em->flush();
        }

        return $this->redirectToRoute('app_bingo_listing_list_bingo');
    }
}
