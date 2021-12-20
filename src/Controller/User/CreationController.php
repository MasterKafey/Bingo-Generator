<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Form\Type\User\Creation\CreateUserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/user")]
class CreationController extends AbstractController
{
    #[Route('/register', name: 'app_user_creation_create_user')]
    public function createUser(Request $request, ManagerRegistry $managerRegistry, UserPasswordHasherInterface $hasher): Response
    {
        $user = new User();

        $form = $this->createForm(CreateUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($hasher->hashPassword($user, $user->getPassword()));
            $em = $managerRegistry->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_user_authentication_authenticate_user');
        }

        return $this->render('Page/User/Creation/create_user.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
