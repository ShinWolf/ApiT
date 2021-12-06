<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Form\InscriptionType;
use App\Entity\User;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
        $bytes = random_bytes(10);
var_dump(bin2hex($bytes));

        $form = $this->createForm(InscriptionType::class, $utilisateur);

        if ($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){

                $utilisateur->setEmail($form->get('email')->getData());
                $utilisateur->setPassword($passwordHasher->hashPassword($utilisateur,$form->get('password')->getData()));
                $utilisateur->setRoles($form->get('roles')->getData());
                $utilisateur->setDateInscription(new \DateTime());
                $utilisateur->setIdUnique(uniqId('MCP_'));

                $em = $this->getDoctrine()->getManager();
                $em->persist($utilisateur);
                $em->flush();

                //return $this->redirectToRoute('accueil');
            }
        }

        return $this->render('static/inscription.html.twig', [
            'form'=>$form->createView()]);
        
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/ajoutCompetence', name: 'ajoutCompetence')]
    public function ajoutCompetence(): Response
    {
        return $this->render('static/ajoutCompetence.html.twig', [
        ]);
         
    }
}
