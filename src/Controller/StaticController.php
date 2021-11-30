<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\InscriptionType;

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
}
