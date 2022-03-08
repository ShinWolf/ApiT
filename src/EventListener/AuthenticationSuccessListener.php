<?php

namespace App\EventListener;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;


class AuthenticationSuccessListener{

  /**
    * @param AuthenticationSuccessEvent $event
  */
  public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
  {
    $data = $event->getData();
    $user = $event->getUser();

    if (!$user instanceof UserInterface) {
        return;
    }

    // Récupéré par l'utilisateur à sa connexion
    $data['data'] = array(
        'email' => $user->getEmail(),
        'roles' => $user->getRoles(),
        'idUnique' => $user->getIdUnique(),
    );

    $event->setData($data);
  }
}