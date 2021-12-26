<?php

namespace App\Controller\User;

use App\Business\UserBusiness;
use App\Entity\BingoCard;
use App\Entity\User;
use App\Form\Type\User\Edition\EditUserConfigurationType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/user/edition')]
class EditionController extends AbstractController
{
    #[Route(path: '/edit_configuration', name: 'app_user_edition_edit_configuration')]
    public function editUserConfiguration(Request $request, ManagerRegistry $managerRegistry, UserBusiness $userBusiness): Response
    {
        $user = $userBusiness->getCurrentUser();
        $configuration = $user->getConfiguration();

        $form = $this->createForm(EditUserConfigurationType::class, $configuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $managerRegistry->getManager();
            $em->persist($configuration);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        $bingoCard = $managerRegistry->getRepository(BingoCard::class)->findOneByUser($user);

        return $this->render('Page/User/Edition/edit_configuration.html.twig', [
            'form' => $form->createView(),
            'bingo_card' => $bingoCard,
        ]);
    }
}
