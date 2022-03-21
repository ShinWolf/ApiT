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
    $atribuers = $user->getAtribuers();
    $comp = array();
    foreach($atribuers as $a){
      $comp[] = $a->getCompetence()->getLibelle();
    }

    if (!$user instanceof UserInterface) {
        return;
    }

    // Données récupérées par l'utilisateur à sa connexion
    $data['data'] = array(
        'email' => $user->getEmail(),
        'roles' => $user->getRoles(),
        'idUnique' => $user->getIdUnique(),
        'competences' => $comp,
    );

    $event->setData($data);
  }
}