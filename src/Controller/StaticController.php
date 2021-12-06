<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\InscriptionType;
use App\Form\AjoutCompetenceType;

class StaticController extends AbstractController
{
    #[Route('/static', name: 'static')]
    public function index(): Response
    {
        return $this->render('static/index.html.twig', [
            'controller_name' => 'StaticController',
        ]);
    }

    #[Route('/inscription', name: 'inscription')]
    public function inscription(): Response
    {
        $form = $this->createForm(InscriptionType::class);
        return $this->render('static/inscription.html.twig', [
            'form'=>$form->createView()]);
        
    }

     #[Route('/ajoutCompetence', name: 'ajoutCompetence')]
     public function ajoutCompetence(): Response
     {
        $form = $this->createForm(AjoutCompetenceType::class);
         return $this->render('static/ajoutCompetence.html.twig', [
            'form'=>$form->createView()]);
         
     }
}
