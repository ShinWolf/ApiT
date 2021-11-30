<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Form\InscriptionType;
use App\Entity\User;


class StaticController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(): Response
    {
        return $this->render('static/index.html.twig', [
            'controller_name' => 'StaticController',
        ]);
    }

    #[Route('/inscription', name: 'inscription')]
    public function inscription(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $utilisateur = new User();

        $form = $this->createForm(InscriptionType::class, $utilisateur);

        if ($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){

                $utilisateur->setEmail($form->get('email')->getData());
                $utilisateur->setPassword($passwordHasher->hashPassword($utilisateur,$form->get('password')->getData()));
                $utilisateur->setRoles(array('ROLE_USER'));
                $date = date('j-F-Y H:i:s', time());
                $utilisateur->setDateInscription($date);

                $em = $this->getDoctrine()->getManager();
                $em->persist($utilisateur);
                $em->flush();

                //return $this->redirectToRoute('accueil');
            }
        }


        return $this->render('static/inscription.html.twig', [
            'form'=>$form->createView()]);
        
    }
}
