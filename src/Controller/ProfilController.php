<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Atribuer;
use App\Entity\User;

use App\Repository\AtribuerRepository;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'profil')]
    public function index(AtribuerRepository $repo): Response
    {
        $user = $this->getUser();
        $userIdUnique = $user->getIdUnique();
        if(isset($_GET['idUnique'])){
         
        $atribuers = $repo->atribuersByUser($_GET['idUnique']);
    }

        return $this->render('profil/profil.html.twig', ['atribuers' => $atribuers]);
    }

     #[Route('/meProfil', name: 'meProfil')]
     public function meProfil(AtribuerRepository $repo): Response
     {
         $user = $this->getUser();
         $userIdUnique = $user->getIdUnique();
        
         $atribuers = $repo->atribuersByUser($userIdUnique);
     
 
         return $this->render('profil/meProfil.html.twig', ['atribuers' => $atribuers]);
     }
}
