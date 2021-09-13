<?php

namespace App\Controller;

use App\Entity\Site;
use App\Repository\SiteRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use App\Form\ContactType;

class SecurityController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, SiteRepository $siteRepository, UtilisateurRepository $utilisateurRepository): Response
    {
        $session = new Session();
        // si on est déjà loger, on est redirigé vers la page adminboard ou user sur le premier site ou l'accueil
        if ($this->getUser()) {
            $actualUser = $this->getUser();
            $roleUser = $actualUser->getRoles();
            $roleName = $actualUser->getLogname();
            // dd($roleUser);
            //si l'autentification est admin on va sur la route adminboard
            if ($roleUser[0] == "ROLE_ADMIN") {
                return $this->redirectToRoute('admin_board');
            }
            //si l'autentification est user on verifie si le user est lié a un ou plusieurs sites
            //soit on route vers la page customerBoard en chargeant le premier site dans la session 
            //          et premier equipement s'il y en existe
            //soit on retourne à logout
            if ($roleUser[0] == "ROLE_USER") {
                $premmierSiteUserTrouve = $actualUser->getSite()->current();
                if ($premmierSiteUserTrouve != false) {
                    $session->set('sessionSiteID', $premmierSiteUserTrouve->getId());
                    $unsite = new Site;
                    $unsite->getEquipements();
                    $lePremierEquipement = $premmierSiteUserTrouve->getEquipements()->current();
                    if ($lePremierEquipement != false) {
                        $idEquipement = $lePremierEquipement->getId();
                        $session->set('sessionEquID', $idEquipement);
                    }
                    return $this->redirectToRoute('customer_board');
                } else {
                    return $this->redirectToRoute('app_logout');
                }
                return $this->redirectToRoute('customer_board');
            }
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/contactpublic", name="contact_public")
     */
    public function contact(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            // return $this->redirectToRoute('contact_index', [], Response::HTTP_SEE_OTHER);
            return $this->redirectToRoute('home');
        }

        return $this->renderForm('contact.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);

    }

    /**
     * @Route("/mentionslegales", name="mentions_legales")
     */
    public function mentionslegales(): Response
    {
        

        return $this->render('mentionsLegales.html.twig');
    }
    
    /**
     * @Route("/apropos", name="a_propos")
     */
    public function apropos(): Response
    {
        

        return $this->render('aPropos.html.twig');
    }
}
