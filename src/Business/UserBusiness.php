<?php

namespace App\Business;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Contracts\Service\Attribute\Required;

class UserBusiness
{
    private TokenStorageInterface $tokenStorage;

    #[Required]
    public function setTokenStorage(TokenStorageInterface $tokenStorage): self
    {
        $this->tokenStorage = $tokenStorage;

        return $this;
    }

    public function getCurrentUser(): ?User
    {
        $token = $this->tokenStorage->getToken();
        if (null === $token) {
            return null;
        }

        $user = $token->getUser();

        if ($user instanceof User) {
            return $user;
        }

        return null;
    }

}
