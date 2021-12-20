<?php

namespace App\Controller\User;

use App\Form\Type\User\Authentication\AuthenticateUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/authentication')]
class AuthenticationController extends AbstractController
{
    #[Route('/login', name: 'app_user_authentication_authenticate_user')]
    public function authenticateUser(): Response
    {
        $form = $this->createForm(AuthenticateUserType::class);

        return $this->render('Page/User/Authentication/authenticate_user.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/logout', name: 'app_user_authentication_logout_user')]
    public function logoutUser(): void
    {
        throw new \RuntimeException('Should never be called');
    }
}
