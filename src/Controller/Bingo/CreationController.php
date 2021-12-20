<?php

namespace App\Controller\Bingo;

use App\Entity\Bingo;
use App\Entity\BingoCell;
use App\Form\Type\Bingo\Creation\CreateBingoType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bingo/creation')]
class CreationController extends AbstractController
{
    #[Route('/create_user', name: 'app_bingo_creation_create_bingo')]
    public function createBingo(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $bingo = (new Bingo())->setCreationDate(new \DateTime());
        $form = $this->createForm(CreateBingoType::class, $bingo);

        for ($i = 0; $i < $form->get('height')->getData() * $form->get('width')->getData(); ++$i) {
            $bingo->addCell(new BingoCell());
        }
        $form->setData($bingo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $managerRegistry->getManager();
            $em->persist($bingo->setUser($this->getUser()));
            $em->flush();

            return $this->redirectToRoute('app_bingo_listing_list_bingo');
        }

        return $this->render('Page/Bingo/Creation/create_bingo.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
